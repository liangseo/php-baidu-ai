<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Face\FaceAnalysis;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app) {
        $app['human_analysis'] = function ($app) {
            return new Client($app);
        };
    }
}