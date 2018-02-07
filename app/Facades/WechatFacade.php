<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class WechatFacade extends Facade {
    protected static function getFacadeAccessor() { return 'WechatService'; }
}
?>