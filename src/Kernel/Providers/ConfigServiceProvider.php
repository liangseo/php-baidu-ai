<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Providers;
use BaiduAi\Kernel\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{

    //方法应仅用于配置服务和参数
    public function register(Container $pimple){
        $pimple['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}