<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
    }

    public function open(){

    }
}
?>