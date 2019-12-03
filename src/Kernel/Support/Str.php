<?php
/**
 * author: liang
 * date: 2019/10/23
 */

namespace BaiduAi\Kernel\Support;


class Str
{
    protected static $studlyCache;

    public static function studly($value){
        $key = $value;
        if(static::$studlyCache[$key]){
            return static::$studlyCache[$key];
        }

        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }
}