<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel;


use BaiduAi\Kernel\Contracts\AccessTokenInterface;
use BaiduAi\Kernel\Traits\HasHttpRequests;
use http\Exception\InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseAccessToken implements AccessTokenInterface
{
    use HasHttpRequests, InteractsWithCache;

    protected $app;

    protected $requestMethod = 'GET';

    protected $endpointToGetToken;

    protected $queryName;

    protected $token;

    protected $safeSeconds = 500;

    protected $tokenKey = 'access_token';

    protected $cachePrefix = 'baiduai.kernel.access_token';

    public function __construct(Container $app) {
        $this->app = $app;
    }

    public function getRefreshedToken(): array{
        return $this->getToken(true);
    }

    public function getToken(bool $refresh = false): array {
        $cacheKey = $this->getCacheKey();
        $cache = $this->getCache();

        if (!$refresh && $cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }

        $token = $this->requestToken($this->getCredenttials(), true);
        $this->setToken($token[$this->tokenKey], $token['expires_in'] ?? 7200);

        return $token;
    }

    public function setToken(string $token, int $expire = 7200): AccessTokenInterface {
        $this->getCache()->set($this->getCacheKey(), [
            $this->tokenKey => $token,
            'expires_in' => $expire,
        ], $expire - $this->safeSeconds);

        if (!$this->getCache()->has($this->getCacheKey())) {
            throw new \RuntimeException('Failed to cache access token.');
        }

        return $this;
    }

    public function refresh(): AccessTokenInterface{
        $this->getToken(true);
    }

    public function requestToken(array $credentials, $toArray =false) {
        $response = $this->sendRequest($credentials);

        $result = json_decode($response->getBody()->getContents(), true);
        $formatted = $this->castResponseToType($response, $this->app['config']->get('response_type'));

        if (empty($result[$this->tokenKey])) {
            throw new HttpException('Request access_token fail:'.json_encode($result, JSON_UNESCAPED_UNICODE), $response, $formatted);
        }

        return $toArray ? $result : $formatted;
    }

    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $query);

        $query = http_build_query(array_merge($this->getQuery(), $query));

        return $request->withUri($request->getUri()->withQuery($query));
    }

    protected function sendRequest(array $credentials): ResponseInterface {
        $options = [
            ('GET' === $this->requestMethod) ? 'query' : 'json' =>$credentials,
        ];

        return $this->setHttpClient($this->app['http_client'])->request($this->getEndpoint(), $this->requestMethod, $options);
    }

    protected function getCacheKey() {
        return $this->cachePrefix.md5(json_encode($this->getCredentials()));
    }

    protected function getQuery():array {
        return [$this->queryName ?? $this->tokenKey => $this->getToken()[$this->tokenKey]];
    }

    public function getEndpoint(): string {
        if (empty($this->endpointToGetToken)) {
            throw new InvalidArgumentException('No endpoint for access token request.');

            return $this->endpointToGetToken;
        }
    }

    public function getTokenKey() {
        return $this->tokenKey;
    }

    abstract protected function getCredentials() :array;

}