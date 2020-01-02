<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel;
use BaiduAi\Kernel\Providers\ConfigServiceProvider;
use BaiduAi\Kernel\Providers\HttpClientServiceProvider;
use BaiduAi\Kernel\Providers\LogServiceProvider;
use BaiduAi\Kernel\Providers\RequestServiceProvider;
use Pimple\Container;

class ServiceContainer extends Container
{

    protected $id;

    protected $providers = [];

    protected $defaultConfig = [];

    protected $userConfig = [];

    public function __construct(array $config = [], array $prepends = []){
        $this->registerProviders($this->getProviders());

        parent::__construct($prepends);

        $this->id = md5(json_encode($config));
    }

    public function getConfig(){
        $base = [
            'http' => [
                'timeout'   => '30',
                'base_uri'  => 'https://aip.baidubce.com/'
            ],
        ];

        return array_replace_recursive($base, $this->defaultConfig, $this->userConfig);
    }

    public function getProviders(){
        return array_merge([
            ConfigServiceProvider::class,
            LogServiceProvider::class,
            RequestServiceProvider::class,
            HttpClientServiceProvider::class,
        ], $this->providers);
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    public function registerConfig(array $config) {
        $this['config'] = function () use ($config) {
          return new Config(array_replace_recursive($this->defaultConfig, $config));
        };
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

}