<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['text_auth'] = function ($app) {
            return new Client($app);
        };
    }
}