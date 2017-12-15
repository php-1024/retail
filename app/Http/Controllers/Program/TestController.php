<?php
namespace App\Http\Controllers\Program;
use App\Http\Controllers\Controller;
class TestController extends Controller{
    public function test(){

        $info = HttpCurl::doget('http://www.baidu.com');
        dump($info);
    }
}
?>