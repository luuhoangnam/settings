<?php

namespace Namest\Settings;

use ArrayAccess;
use Namest\Settings\Contracts\Settings\Repository as SettingContract;

/**
 * Class Repository
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Settings
 *
 */
class Repository implements ArrayAccess, SettingContract
{
    protected $settings = [];

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        if (array_key_exists($key, $this->settings))
            return true;

        return \DB::table('settings')
                  ->where('key', '=', $key)
                  ->first(['key']) != null;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        if (array_key_exists($key, $this->settings))
            return $this->settings[$key];

        $result = \DB::table('settings')
                     ->where('key', '=', $key)
                     ->first(['value']);

        if ( ! $result)
            return $this->settings[$key] = null;

        return $this->settings[$key] = $result->value;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function offsetSet($key, $value)
    {
        $this->settings[$key] = $value;

        \DB::table('settings')
           ->where('key', '=', $key)
           ->update(['value' => $value]);
    }

    /**
     * @param string $key
     */
    public function offsetUnset($key)
    {
        $this->settings[$key] = null;

        \DB::table('settings')
           ->where('key', '=', $key)
           ->update(['value' => null]);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function load($key)
    {
        $result = \DB::table('settings')
                     ->where('key', '=', $key)
                     ->first(['value']);

        if ( ! $result)
            return $this->settings[$key] = null;

        return $this->settings[$key] = $result->value;
    }

    public function preload()
    {
        $this->settings = \DB::table('settings')
                             ->where('preload', '=', true)
                             ->lists('value', 'key');
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($this->has($key))
            return $this[$key];

        return $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value = null)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->settings = \DB::table('settings')->lists('value', 'key');
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this[$key];
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }
}
