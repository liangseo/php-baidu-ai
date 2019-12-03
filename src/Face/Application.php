<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Face;


use BaiduAi\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        FaceAnalysis\ServiceProvider::class,
        FaceLibrary\ServiceProvider::class,
    ];

    public function __call($method, $args) {
        return $this->base->$method(...$args);
    }

}