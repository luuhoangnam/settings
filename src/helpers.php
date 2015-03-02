<?php

if ( ! function_exists('setting')) {
    /**
     * @param string $key
     * @param mixed  $default
     */
    function setting($key, $default = null)
    {
        return app(Namest\Settings\Contracts\Repository::class)->get($key, $default);
    }
}
