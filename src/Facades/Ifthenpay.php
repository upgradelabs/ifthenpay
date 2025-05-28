<?php

namespace Upgradelabs\Ifthenpay\Facades;

use Illuminate\Support\Facades\Facade;

class Ifthenpay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ifthenpay';
    }
}
