<?php

namespace ksmz\NanaLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Nana extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nana';
    }
}
