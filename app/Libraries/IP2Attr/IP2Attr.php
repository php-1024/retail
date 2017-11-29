<?php
namespace App\Libraries\IP2Attr;
use App\Libraries\Curl\HttpCurl;
/*
 * 根据IP获取地址接口
 */
class IP2Attr{
    public static function getAttr($ip){
        echo $ip;
    }
    public static function sina_api($ip){
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip;
        $response = HttpCurl::doGet($url);
        dump($response);
    }
}
?>