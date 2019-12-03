<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Log;

use BaiduAi\Kernel\ServiceContainer;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogHandler;
use Psr\Log\LoggerInterface;
use Monolog\Logger as Monolog;

class LogManager implements LoggerInterface {

    protected $app;

    protected $channels = [];

    protected $customCreators = [];

    protected $levels = [
        'debug'     => Monolog::DEBUG,
        'info'      => Monolog::INFO,
        'notice'    => Monolog::NOTICE,
        'warning'   => Monolog::WARNING,
        'error'     => Monolog::ERROR,
        'critical'  => Monolog::CRITICAL,
        'alert'     => Monolog::ALERT,
        'emergency' => Monolog::EMERGENCY,
    ];

    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    public function stack(array $channels, $channel = null)
    {
        return $this->createStackDriver(compact('channels', 'channel'));
    }

    public function channel($channel = null)
    {
        return $this->get($channel);
    }

    public function driver($driver = null)
    {
        return $this->get($driver ?? $this->getDefaultDriver());
    }

    protected function get($name)
    {
        try {
            return $this->channels[$name] ?? ($this->channels[$name] = $this->resolve($name));
        } catch (\Throwable $e) {
            $logger = $this->createEmergencyLogger();

            $logger->emergency('Unable to create configured logger. Using emergency logger.', [
                'exception' => $e,
            ]);

            return $logger;
        }
    }

    protected function resolve($name)
    {
        $config = $this->app['config']->get(\sprintf('log.channels.%s', $name));

        if (is_null($config)) {
            throw new \InvalidArgumentException(\sprintf('Log [%s] is not defined.', $name));
        }

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($config);
        }

        $driverMethod = 'create'.ucfirst($config['driver']).'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new \InvalidArgumentException(\sprintf('Driver [%s] is not supported.', $config['driver']));
    }

    protected function createEmergencyLogger()
    {
        return new Monolog('EasyWeChat', $this->prepareHandlers([new StreamHandler(
            \sys_get_temp_dir().'/easywechat/easywechat.log', $this->level(['level' => 'debug'])
        )]));
    }

    protected function callCustomCreator(array $config)
    {
        return $this->customCreators[$config['driver']]($this->app, $config);
    }

    protected function createStackDriver(array $config)
    {
        $handlers = [];

        foreach ($config['channels'] ?? [] as $channel) {
            $handlers = \array_merge($handlers, $this->channel($channel)->getHandlers());
        }

        return new Monolog($this->parseChannel($config), $handlers);
    }

    protected function createSingleDriver(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(
                new StreamHandler($config['path'], $this->level($config))
            ),
        ]);
    }

    protected function createDailyDriver(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new RotatingFileHandler(
                $config['path'], $config['days'] ?? 7, $this->level($config)
            )),
        ]);
    }

    protected function createSlackDriver(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new SlackWebhookHandler(
                $config['url'],
                $config['channel'] ?? null,
                $config['username'] ?? 'EasyWeChat',
                $config['attachment'] ?? true,
                $config['emoji'] ?? ':boom:',
                $config['short'] ?? false,
                $config['context'] ?? true,
                $this->level($config)
            )),
        ]);
    }

    protected function createSyslogDriver(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new SyslogHandler(
                    'EasyWeChat', $config['facility'] ?? LOG_USER, $this->level($config))
            ),
        ]);
    }

    protected function createErrorlogDriver(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new ErrorLogHandler(
                    $config['type'] ?? ErrorLogHandler::OPERATING_SYSTEM, $this->level($config))
            ),
        ]);
    }

    protected function prepareHandlers(array $handlers)
    {
        foreach ($handlers as $key => $handler) {
            $handlers[$key] = $this->prepareHandler($handler);
        }

        return $handlers;
    }

    protected function prepareHandler(HandlerInterface $handler)
    {
        return $handler->setFormatter($this->formatter());
    }

    protected function formatter()
    {
        $formatter = new LineFormatter(null, null, true, true);
        $formatter->includeStacktraces();

        return $formatter;
    }

    protected function parseChannel(array $config)
    {
        return $config['name'] ?? null;
    }

    protected function level(array $config)
    {
        $level = $config['level'] ?? 'debug';

        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        }

        throw new \InvalidArgumentException('Invalid log level.');
    }

    public function getDefaultDriver()
    {
        return $this->app['config']['log.default'];
    }

    public function setDefaultDriver($name)
    {
        $this->app['config']['log.default'] = $name;
    }

    public function extend($driver, \Closure $callback)
    {
        $this->customCreators[$driver] = $callback->bindTo($this, $this);

        return $this;
    }

    public function emergency($message, array $context = [])
    {
        return $this->driver()->emergency($message, $context);
    }

    public function alert($message, array $context = [])
    {
        return $this->driver()->alert($message, $context);
    }

    public function critical($message, array $context = [])
    {
        return $this->driver()->critical($message, $context);
    }

    public function error($message, array $context = [])
    {
        return $this->driver()->error($message, $context);
    }

    public function warning($message, array $context = [])
    {
        return $this->driver()->warning($message, $context);
    }

    public function notice($message, array $context = [])
    {
        return $this->driver()->notice($message, $context);
    }

    public function info($message, array $context = [])
    {
        return $this->driver()->info($message, $context);
    }

    public function debug($message, array $context = [])
    {
        return $this->driver()->debug($message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        return $this->driver()->log($level, $message, $context);
    }

    public function __call($method, $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }
}