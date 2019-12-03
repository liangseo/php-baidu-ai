<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Contracts;


use Psr\Http\Message\RequestInterface;

interface AccessTokenInterface
{
    public function getToken(): array;

    public function refresh(): self;

    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface;
}