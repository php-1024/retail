<?php
namespace App\Libraries\IP2Attr;
use App\Libraries\Curl\HttpCurl;
/*
 * 根据IP获取地址接口
 */
class IP2Attr{
    public static function getAttr($ip){
        if($ip=='127.0.0.1'){
            return '本机';
        }else if($ip=='0.0.0.0'){

        }else{
            return self::sina_api($ip);
        }
    }
    public static function sina_api($ip){
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip;
        $response = HttpCurl::doGet($url);
        if(preg_match('/{.*}/iUs',$response,$arr)){
            dump($arr);
        }
    }
}
?>