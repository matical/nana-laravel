<?php

namespace ksmz\NanaLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/** @mixin \ksmz\NanaLaravel\LaravelFetch */
class Nana extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nana';
    }
}
