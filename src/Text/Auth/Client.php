<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text\Auth;


use BaiduAi\Kernel\BaseClient;

class Client extends BaseClient
{
    public function session() {
        $params = [
            'client_id'      => $this->app['config']['client_id'],
            'client_secret'  => $this->app['config']['client_secret'],
            'grant_type'     => 'client_credentials',
        ];

        return $this->httpGet('', $params);
    }
}