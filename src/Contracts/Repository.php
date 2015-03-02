<?php

namespace Namest\Settings\Contracts;

/**
 * Interface Repository
 *
 * @author  Nam Hoang Luu <nam@mbearvn.com>
 * @package Namest\Settings\Contracts\Settings
 *
 */
interface Repository
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function has($key);

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function set($key, $value = null);

    /**
     * @return array
     */
    public function all();
}
