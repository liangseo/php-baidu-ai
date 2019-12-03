<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Kernel\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

trait HasHttpRequests
{
    use ResponseCastable;

    protected $httpClient;

    protected $middlewares = [];

    protected $handleStack;

    protected static $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ],
    ];

    public static function setDefaultOptions($defaults = []){
        self::$defaults = $defaults;
    }

    public static function getDefaultOptions(): array
    {
        return self::$defaults;
    }

    // ?
    public function setHttpClient(ClientInterface $httpClient){
        $this->httpClient = $httpClient;
        return $this;
    }

    public function getHttpClient(): ClientInterface{
        if(!($this->httpClient instanceof ClientInterface)){
            if(property_exists($this, 'app') && $this->app['http_client']) {
                $this->httpClient = $this->app['http_client'];
            } else {
                $this->httpClient = new Client(['handler'=>HandlerStack::create($this->getGuzzleHandler())]);
            }
        }

        return $this->httpClient;
    }

    public function pushMiddleware(callable $middleware, string $name = null){
        if (!is_null($name)) {
            $this->middlewares[$name] = $middleware;
        } else {
            array_push($this->middlewares, $middleware);
        }

        return $this;
    }

    public function getMiddlewares(): array {
        return $this->middlewares;
    }

    public function request($url, $method = 'GET', $options = []): ResponseInterface{
        $method = strtoupper($method);

        $options = array_merge(self::$defaults, $options, ['handler'=>$this->getHandlerStack()]);

        $options = $this->fixJsonIssue($options);

        if (property_exists($this, 'baseUrl') && !is_null($this->baseUri)) {
            $options['base_uri'] = $this->baseUri;
        }

        $response = $this->getHttpClient()->request($method, $url, $options);
        $response->getBody()->rewind();

        return $response;
    }

    public function setHandlerStack(HandlerStack $handlerStack){
        $this->handleStack = $handlerStack;
        return $this;
    }

    public function getHandlerStack(): HandlerStack{
        if ($this->handleStack) {
            return $this->handleStack;
        }

        $this->handleStack = HandlerStack::create($this->getGuzzleHandler());
        foreach ($this->middlewares as $name => $middleware) {
            $this->handleStack->push($middleware, $name);
        }

        return $this->handleStack;
    }

    protected function fixJsonIssue(array $options): array {
        if (isset($options['json']) && is_array($options['json'])) {
            $options['headers'] = array_merge($options['headers'] ?? [], ['Content-Type' => 'application/json']);

            if(empty($options['json'])) {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_FORCE_OBJECT);
            } else {
                $options['body'] = \GuzzleHttp\json_encode($options['json'], JSON_UNESAPED_UNICODE);
            }

            unset($options['json']);
        }

        return $options;
    }

    public function getGuzzleHandler(){
        if (property_exists($this, 'app') && isset($this->app['guzzle_handler']) && is_string($this->app['guzzle_handler'])) {
            $handler = $this->app['guzzle_handler'];

            return new $handler;
        }

        return \GuzzleHttp\choose_handler();
    }

}