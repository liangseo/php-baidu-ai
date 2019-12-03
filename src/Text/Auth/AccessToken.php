<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Auth;


use BaiduAi\Kernel\BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected $endpointToGetToken = '';

    protected function getCredentials(): array
    {
        return [
            'grant_type'  => 'client_credential',
            'appid'       => $this->app['config']['app_id'],
            'secret'      => $this->app['config']['secret']
        ];
    }
}