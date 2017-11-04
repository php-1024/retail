<?php
/**
 * Created by PhpStorm.
 * User: zeo
 * Date: 2017/11/4
 * Time: 22:45
 * 本文件用于学习Redis.
 */
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Redis\RedisManager;
class RedisController extends Controller{
    public function study(){
        dump("开始学习Redis了");
        //app('redis.connection') 默认连接default
        //app('redis')->connection('zeo') 连接到我定义的redis服务器
        //app('redis')->connection('lingyikeji') //连接到lingyikeji集群对象

        dump("最简单的Redis的存取");
        $redis = app('redis.connection.zeo');//连接到我的redis服务器
        $redis->set('test1', '这是第一个Redis示例');
        $test1 = $redis->get('test1');
        dump($test1);
    }
}