<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Text\Education;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['education'] = function ($app) {
            return new Client($app);
        };
    }
}