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
        $row = DB::connection('study')->table('test')->where('name','like','%test%')->pluck('name')->pluck('age');
        dump($row);
    }
}
?>