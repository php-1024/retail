<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class IP2AttrFacade extends Facade {
    protected static function getFacadeAccessor() { return 'IP2AttrService'; }
}
?>