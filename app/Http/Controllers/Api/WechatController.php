<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
    }

    public function open(){

    }
}
?>