<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Kernel;


use BaiduAi\Kernel\Contracts\AccessTokenInterface;
use BaiduAi\Kernel\Traits\HasHttpRequests;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    use HasHttpRequests { request as performRequest; }

    protected $app;

    protected $accessToken;

    protected $baseUri;

    public function __construct(ServiceContainer $app, AccessTokenInterface $accessToken = null){
        $this->app = $app;
        $this->accessToken = $accessToken ?? $this->app['access_token'];
    }

    public function httpGet(string $url, array $query = []) {
        return $this->request($url, 'GET', ['query'=>$query]);
    }

    public function httpPost(string $url, array $data = []) {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    public function httpPostJson(string $url, array $data = [], array $query = []) {
        return $this->request($url, 'POST', ['query'=>$query, 'json'=>$data]);
    }

    public function httpUpload(string $url, array $files = [], array $form = [], array $query = []) {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name'     => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        $requestParams = [
                'query'           =>$query,
                'multipart'       =>$multipart,
                'connect_timeout' =>30,
                'timeout'         =>30,
                'read_timeout'    =>30
            ];

        return $this->request($url, 'POST', $requestParams);
    }

    public function getAccessToken():AccessTokenInterface {
        return $this->accessToken;
    }

    public function setAccessToken(AccessTokenInterface $accessToken) {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false){
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }

    public function requestRaw(string $url, string $method = 'GET', array $options = []) {
        return Response::buildFromPsrResponse($this->request($url, $method, $options, true));
    }

    protected function registerHttpMiddlewares() {
        $this->pushMiddleware($this->retryMiddleware(), 'retry');
        $this->pushMiddleware($this->accessTokenMiddleware(), 'access_token');
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    protected function accessTokenMiddleware() {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if ($this->accessToken) {
                    $request = $this->accessToken->applyToRequest($request, $options);
                }

                return $handler($request, $options);
            };
        };
    }

    protected function logMiddleware() {
        $logTemplate = $this->app['config']['http.log_template'] ?? MessageFormatter::DEBUG;

        $formatter = new MessageFormatter($logTemplate);

        return Middleware::log($this->app['logger'], $formatter);
    }

    protected function retryMiddleware() {
        return Middleware::retry(function (
            $retries,
            RequestInterface $request,
            ResponseInterface $response = null
        ) {
            if ($retries < $this->app->config->get('http.max_retries', 1) && $response && $body = $response->getBody()) {
                $response = json_decode($body, true);

                if (!empty($response['errcode']) && in_array(abs($response['errcode']), [40001, 40014, 42001], true)) {
                    $this->accessToken->refresh();

                    $this->app['logger']->debug('Retrying with refreshed access token.');

                    return true;
                }
            }

            return false;
        }, function () {
            return abs($this->app->config->get('http.retry_delay', 500));
        });
    }

}