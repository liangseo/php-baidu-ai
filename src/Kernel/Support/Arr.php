<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Support;


class Arr
{
    public static function add(array $array, $key, $value) {
        if (is_null(static::get($array, $key))) {
            static::set($array, $key, $value);
        }

        return $array;
    }

    public static function crossJoin(...$arrays) {
        $results = [[]];

        foreach ($arrays as $index => $array) {
            $append = [];

            foreach ($results as $product) {
                foreach ($array as $item) {
                    $product[$index] = $item;

                    $append[] = $product;
                }
            }
        }

        return $results;
    }

    public static function divide(array $array) {
        return [array_keys($array), array_values($array)];
    }

    public static function dot(array $array, $prepend = '') {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, static::dot($value, $prepend.$key,'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }

    public static function except(array $array, $keys) {
        static::forget($array, $keys);
    }

    public static function exists(array $array, $key) {
       return array_key_exists($key, $array);
    }

    public static function first(array $array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($array)) {
                return $default;
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    public static function last(array $array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return empty($array) ? $default : end($array);
        }

        return static::first(array_reverse($array, true), $callback, $default);
    }

    public static function flatten(array $array, $depth = INF)
    {
        return array_reduce($array, function ($result, $item) use ($depth) {
            $item = $item instanceof Collection ? $item->all() : $item;

            if (!is_array($item)) {
                return array_merge($result, [$item]);
            } elseif (1 === $depth) {
                return array_merge($result, array_values($item));
            }

            return array_merge($result, static::flatten($item, $depth - 1));
        }, []);
    }

    public static function forget(array &$array, $keys)
    {
        $original = &$array;

        $keys = (array) $keys;

        if (0 === count($keys)) {
            return;
        }

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }

    public static function get(array $array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (static::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }

    public static function has(array $array, $keys)
    {
        if (is_null($keys)) {
            return false;
        }

        $keys = (array) $keys;

        if (empty($array)) {
            return false;
        }

        if ($keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (static::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public static function isAssoc(array $array)
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    public static function only(array $array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    public static function prepend(array $array, $value, $key = null)
    {
        if (is_null($key)) {
            array_unshift($array, $value);
        } else {
            $array = [$key => $value] + $array;
        }

        return $array;
    }

    public static function pull(array &$array, $key, $default = null)
    {
        $value = static::get($array, $key, $default);

        static::forget($array, $key);

        return $value;
    }

    public static function random(array $array, int $amount = null)
    {
        if (is_null($amount)) {
            return $array[array_rand($array)];
        }

        $keys = array_rand($array, $amount);

        $results = [];

        foreach ((array) $keys as $key) {
            $results[] = $array[$key];
        }

        return $results;
    }

    public static function set(array &$array, string $key, $value)
    {
        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    public static function where(array $array, callable $callback)
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

    public static function wrap($value)
    {
        return !is_array($value) ? [$value] : $value;
    }

}