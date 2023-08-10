<?php

namespace Shengamo\LaravelEmsikaSms\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEmsikaSms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-emsika-sms';
    }
}
