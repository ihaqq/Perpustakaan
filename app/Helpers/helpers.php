<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveMenu')) {
    function isActiveMenu(array $routes): string
    {
        return Route::is(...$routes) ? 'active' : '';
    }
}
