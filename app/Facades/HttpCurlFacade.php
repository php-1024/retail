<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class HttpCurlFacade extends Facade {
    protected static function getFacadeAccessor() { return 'HttpCurlService'; }
}
?>