<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Universal;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['universal'] = function ($app) {
            return new Client($app);
        };
    }
}