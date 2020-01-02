<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Face\Auth;


use BaiduAi\Kernel\BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected $endpointToGetToken = '';

    protected function getCredentials(): array
    {
        return [
            'grant_type'     => 'client_credentials',
            'client_id'      => $this->app['config']['client_id'],
            'client_secret'  => $this->app['config']['client_secret']
        ];
    }
}