<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Image;


use BaiduAi\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    protected $providers = [
        Auth\ServiceProvider::class,
        HumanAnalysis\ServiceProvider::class,
        ImageEnhancement\ServiceProvider::class,
        ImageRecognition\ServiceProvider::class,
        ImageReview\ServiceProvider::class,
        ImageSearch\ServiceProvider::class,
    ];

    public function __call($method, $args) {
        return $this->base->$method(...$args);
    }

}