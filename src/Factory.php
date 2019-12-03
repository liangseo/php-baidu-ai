<?php
/**
 * Created by PhpStorm.
 * User: liang
 */

namespace BaiduAi;


class Factory
{
    public static function make($name, array $config){
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\BaiduAi\\{$namespace}\\Application";

        return new $application($config);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}