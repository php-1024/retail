<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ZeroneRedisFacade extends Facade {
    protected static function getFacadeAccessor() { return 'ZeroneRedisService'; }
}
?>