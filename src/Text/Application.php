<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Text;


use BaiduAi\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        Bill\ServiceProvider::class,
        Car\ServiceProvider::class,
        Card\ServiceProvider::class,
        Education\ServiceProvider::class,
        Universal\ServiceProvider::class,
    ];

    public function __call($method, $args) {
        return $this->base->$method(...$args);
    }

}