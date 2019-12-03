<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Providers;
use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple){
        $pimple['http_client'] = function ($app) {
            return new Client($app['config']->get('http', []));
        };
    }
}