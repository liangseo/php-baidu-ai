<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Providers;
use Symfony\Component\HttpFoundation\Request;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class RequestServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple){
        $pimple['request'] = function () {
            return Request::createFromGlobals();
        };
    }
}