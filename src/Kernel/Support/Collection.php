<?php
/**
 * author: liang
 * email: z@liangseo.com
 * host: https://www.liangseo.com
 */

namespace BaiduAi\Kernel\Support;

namespace BaiduAi\Kernel\Support;
use ArrayAccess;
use ArrayIterator;
use Countable;
use BaiduAi\Kernel\Contracts\Arrayable;
use IteratorAggregate;
use JsonSerializable;
use Serializable;

class Collection implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable, Serializable, Arrayable
{
    protected $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function all(){
        return $this->items;
    }

    public function only(array $keys){
        $return = [];

        foreach ($keys as $key){
            $value = $this->get($key);

            if(!is_null($value)) {
                $return[$key] = $value;
            }
        }

        return new static($return);
    }

    public function except($keys){
        $keys = is_array($keys) ? $keys : func_get_args();

        return new static(Arr::except($this->items, $keys));
    }

    public function merge($items){
        $clone = new static($this->all());

        foreach ($items as $key=>$value) {
            $clone->set($key, $value);
        }

        return $clone;
    }

    public function has($key){
        return !is_null(Arr::get($this->items, $key));
    }

    public function first(){
        return reset($this->items);
    }

    public function last(){
        $end = end($this->items);

        reset($this->items);

        return $end;
    }

    public function add($key, $value) {
        Arr::set($this->items, $value, $key, $value);
    }

    public function set($key, $value) {
        Arr::set($this->items, $key, $value);
    }

    public function get($key, $default = null) {
        return Arr::get($this->items, $key, $default);
    }

    public function forget($key) {
        Arr::forget($this->items, $key);
    }

    public function toArray() {
        return $this->all();
    }

    public function toJson($option = JSON_UNESCAPED_UNICODE) {
        return json_encode($this->all(), $option);
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function jsonSerialize()
    {
        return $this->items;
    }

    public function serialize()
    {
        return serialize($this->items);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function count() {
        return count($this->items);
    }

    public function unserialize($serialized)
    {
        return $this->unserialize($this->items);
    }

    public function __get($key) {
        return $this->get($key);
    }

    public function __set($key, $value) {
        $this->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        $this->forget($key);
    }

    public function __set_state()
    {
        return $this->all();
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $this->forget($offset);
        }
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->get($offset) : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

}