<?php
namespace App\Http\Controllers\Tooling;
use App\Http\Controllers\Controller;
class TestController extends Controller{
    public function test(){

        $info = \HttpCurl::doget('http://www.baidu.com');
        dump($info);
    }
}
?>