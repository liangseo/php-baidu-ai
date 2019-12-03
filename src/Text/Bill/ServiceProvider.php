<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Bill;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['bill'] = function ($app) {
            return new Client($app);
        };
    }
}