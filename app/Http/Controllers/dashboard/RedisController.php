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
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller{
    public function study(){
        dump("开始学习Redis了");
        //Redis::connection(''); 默认连接default
        //Redis::connection('zeo'); 连接到我定义的redis服务器
        //Redis::connection('lingyikeji');//连接到lingyikeji集群对象

        dump("set(),get()最简单的Redis的存取");
        Redis::connection('zeo');//连接到我的redis服务器
        Redis::set('test1', '这是第一个Redis示例');
        $test1 = Redis::get('test1');
        dump($test1);

        dump("mset(),mget()同时存取多个key-value");
        $list = array(
            'zeo:0001' => '第一个值',
            'zeo:0002' => '第二个值',
            'zeo:0003' => '第三个值'
        );
        Redis::mset($list);
        $ll = Redis::mget(array_keys($list));
        dump($ll);

        dump('存储带时效的key-values');
        //Redis::setex('name', 10, '薛志豪');//存10秒
        //dump(Redis::get('name'));

        dump('setnx添加值时不覆盖原有值');
        /*
        $aa=Redis::setnx('foo', 12) ;  // 返回 true ， 添加成功
        $bb=Redis::setnx('foo', 34) ;  // 返回 false， 添加失败，因为已经存在键名为 foo 的记录
        dump($aa);
        dump($bb);
        dump(Redis::get('foo'));
        */

        dump('getset()替换一个值，并换回替换前的值');
        //$foo = Redis::getset('foo',88);
        //dump($foo);

        dump('incrby(),incr(),decrby(),decr() 对值的递增和递减');
        dump('foo递增1，同时返回递增后的值',Redis::incr('foo'));
        dump('foo递增N，同时返回递增后的值,N为你定义的值，如2',Redis::incrBy('foo',2));
        dump('foo递减1，同时返回递减后的值',Redis::decr('foo'));
        dump('foo递减N，同时返回递减后的值,N为你定义的值，如2',Redis::decrby('foo',2));

        dump('exists()检测是否存在值');
        dump(Redis::exists('foo'));

        dump('type()检测类型');
        dump(Redis::type('foo'));

        dump('del()删除键值');
        dump(Redis::del('foo'));

        dump('append()拼接到已有的字符串');
        Redis::append('test1','_hello world zeo');
        dump(Redis::get('test1'));

        dump('setrange()部分替换操作,第二个参数为0时等同于set操作');
        dump(Redis::setRange('test1',0,'hello world zeo'));
        dump(Redis::get('test1'));
        Redis::setRange('test1',11,'hi');
        dump(Redis::get('test1'));
    }
}