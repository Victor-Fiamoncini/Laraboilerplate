<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActive')) {
    /**
     * Verify current route, if matches, add requested CSS classes
     *
     * @param string $href
     * @param string $class
     * @return string
     */
    function isActive(string $href, string $class = 'active'): string
    {
        return strpos(Route::currentRouteName(), $href) === 0 ? $class : '';
    }
}
