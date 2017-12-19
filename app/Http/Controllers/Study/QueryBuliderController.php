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

    //关联查询
    public function select_join(){
        $list =  DB::connection('study')->table('test')->join('test_sex','test_sex.test_id','=','test.id')->select('test.*','test_sex.sex')->get();
        echo "inner join:";
        dump($list);
        $list2 =  DB::connection('study')->table('test')->leftjoin('test_sex','test_sex.test_id','=','test.id')->select('test.*','test_sex.sex')->get();
        echo "left join";
        dump($list2);
        $list3 =  DB::connection('study')->table('test')->rightjoin('test_sex','test_sex.test_id','=','test.id')->select('test.age','test.name','test_sex.*')->get();
        echo "right join";
        dump($list3);
        echo "高级关联语句";
        $list4 =DB::connection('study')->table('test')->join('test_sex',function($join){
            $join->on('test_sex.test_id','=','test.id')
                 ->where('sex','男');
        })->select('test.*','test_sex.sex')->get();
        dump($list4);
    }

    //联合查询
    public function select_union(){
        //table一定要再where前
        $db = DB::connection('study');
        $first = $db->table('test')->where('id','<','2');
        $list =  $db->table('test')->where('id','>','4')->union($first)->get();
        dump($list);
    }

    //where多数组子查询
    public function select_where(){
        $db = DB::connection('study');
        $list = $db->table('test')->where([['id','>','5'],['name','like','%te%']])->get();
        dump($list);
    }

    //whereOr查询
    public function select_orwhere(){
        $db = DB::connection('study');
        $list = $db->table('test_sex')->where('sex','男')->orWhere('sex','女')->get();
        dump($list);
    }
    //between | not between查询
    public function select_between(){
        $db = DB::connection('study');
        $list = $db->table('test')->whereBetween('id',[1,3])->get();
        dump($list);


        $list2 = $db->table('test')->whereNotBetween('id',[1,3])->get();
        dump($list2);
    }
    //in | not in查询
    public function select_in(){
        $db = DB::connection('study');
        $list = $db->table('test')->whereIn('id',[1,3])->get();
        dump($list);

        $list2 = $db->table('test')->whereNotIn('id',[1,3])->get();
        dump($list2);
    }
    //whereColumn 对比两个字段的值
    public function select_cc(){
        $db = DB::connection('study');
        //查询id = age的列
        $list = $db->table('test')->whereColumn('id','=','age')->get();
        dump($list);
    }
    //高级where方法
    public function select_gjwhere(){
        $db = DB::connection('study');
        //查询id = age的列
        $list = $db->table('test')->where(function($query){
            $query->where('id','>','2');
        })->get();
        dump($list);
    }
    //Exists语句
    public function select_exists(){
        $db = DB::connection('study');
        $list = $db->table('test')->whereExists(function($query){
            $query->where('age','>','10');
        })->get();
        dump($list);
    }
    //排序
    public function select_orderby(){
        $db = DB::connection('study');
        $list = $db->table('test')->orderBy('id','desc')->get();
        dump($list);
    }
}
?>