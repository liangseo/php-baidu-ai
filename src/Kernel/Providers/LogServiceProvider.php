<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Providers;
use BaiduAi\Kernel\Log\LogManager;
use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple){
        $pimple['logger'] = $pimple['log'] = function ($app) {
            $config = $this->formatLogConfig($app);

            if (!empty($config)) {
                $app->rebind('config', $app['config']->merge($config));
            }

            return new LogManager($app);
        };
    }

    public function formatLogConfig($app) {
        if (!empty($app['config']->get('log.channels'))) {
            return $app['config']->get('log');
        }

        if (empty($app['config']->get('log'))){
            return [
                'log' => [
                    'default'  => 'errorlog',
                    'channels' => [
                        'errorlog' => [
                            'driver' => 'errorlog',
                            'level'  => 'debug',
                        ]
                    ]
                ]
            ];
        }

        return [
            'log' => [
                'default' => 'single',
                'channels' => [
                    'single' => [
                        'driver' => 'single',
                        'path' => $app['config']->get('log.file') ?: \sys_get_temp_dir().'/logs/baidu-ai.log',
                        'level' => $app['config']->get('log.level', 'debug'),
                    ],
                ],
            ],
        ];

    }

}