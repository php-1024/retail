<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class WechatErrorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WechatErrorService';
    }
}
