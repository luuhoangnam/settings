<?php

if ( ! function_exists('setting')) {
    /**
     * @param string $key
     * @param mixed  $default
     */
    function setting($key, $default = null)
    {
        return app('settings')->get($key, $default);
    }
}
