<?php
/*
 * Laravel框架，查询构造器用法
 */
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class QueryBuliderController extends Controller{
    //从数据表中查询所有数据
    public function select_all(){
        $list = DB::connection('study')->table('test')->get();
        dump($list);
    }
    //从数据库中获取一行数据
    public function select_first(){
        $row = DB::connection('study')->table('test')->where('name','like','%test2%')->first();
        dump($row);
    }
    //从数据库中获取单一行单一列值数据
    public function select_value(){
        $row = DB::connection('study')->table('test')->where('name','like','%test2%')->value('name');
        dump($row);
    }
    //从数据库中获取多行中查询单一列值数据
    public function select_pluck(){
        $row = DB::connection('study')->table('test')->where('name','like','%test%')->pluck('name');
        dump($row);
    }

    //查询总数
    public function select_count(){
        $count = DB::connection('study')->table('test')->count();
        dump($count);
    }

    //某列的最大值
    public function select_max(){
        $max = DB::connection('study')->table('test')->max('age');
        dump($max);
    }

    //某列的最小值
    public function select_min(){
        $min = DB::connection('study')->table('test')->min('age');
        dump($min);
    }

    //某列的平均值
    public function select_avg(){
        $avg = DB::connection('study')->table('test')->avg('age');
        dump($avg);
    }

    //某列的总和
    public function select_sum(){
        $sum = DB::connection('study')->table('test')->sum('age');
        dump($sum);
    }

    //使用select子句查询
    public function select_column(){
        $list = DB::connection('study')->table('test')->select('name','age as user_age')->get();
        dump($list);
    }

    //多个select子句
    public function select_column2(){
        $list = DB::connection('study')->table('test')->select('name')->addSelect('age as u_age')->get();
        dump($list);
    }

    //过滤查询结果中的重复值
    public function select_distinct(){
        $list = DB::connection('study')->table('test')->select('age')->distinct()->get();
        dump($list);
    }
}
?>