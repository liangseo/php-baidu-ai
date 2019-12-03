<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Image\ImageEnhancement;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['image_enhancement'] = function ($app) {
            return new Client($app);
        };
    }
}