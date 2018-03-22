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
        $row = DB::connection('study')->table('test')->where('name','like','%tttt%')->first();
        dump($row);
    }
    //从数据库中获取单一行单一列值数据
    public function select_value(){
        $row = DB::connection('study')->table('test')->where('name','like','%test2%')->value('created_at');
        dump(date('Y-m-d H:i:s',$row));
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

    //联合查询查询时如果要用到 in  或者 or的 请改用union查询 会快很多
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
        //标准排序
        $db = DB::connection('study');
        $list = $db->table('test')->orderBy('id','desc')->get();
        dump($list);
        //随机排序
        $db = DB::connection('study');
        $list2 = $db->table('test')->inRandomOrder('id','desc')->get();
        dump($list2);
    }

    //groupBy分组 mysql中设置了only_full_group_by的话 需要把查询出来的值都包含在groupBy中，否则会报错
    public function select_groupby(){
        $db = DB::connection('study');
        $list = $db->table('test')->groupBy('age')->select('age')->get();
        dump($list);
    }

    /*
     * having
     * 数据库查询having 和 where 的区别
        1.数据库或查询字段集中没有该字段 只能用where ，不能用having
        2.查询字段集中有该字段但数据库中没有该字段 只能用having，不能用where
        3.其余情况下效果一致。

        只可以用where，不可以用having的情况
        1. select goods_name,goods_number from sw_goods where goods_price > 100
        2.select goods_name,goods_number from sw_goods having goods_price > 100 //报错！！！因为前面并没有筛选出goods_price 字段

        只可以用having，不可以用where情况
        1.select goods_category_id , avg(goods_price) as ag from sw_goods group by goods_category having ag > 1000
        2.select goods_category_id , avg(goods_price) as ag from sw_goods where ag>1000 group by goods_category //报错！！因为from sw_goods 这张数据表里面没有ag这个字段
     */
    public function select_having(){
        $db = DB::connection('study');
        $list = $db->table('test')->having('id','>',3)->get();
        dump($list);
    }
    //offect,limit的两种用法
    public function select_skip(){
        $db = DB::connection('study');
        $list = $db->table('test')->having('id','>',3)->skip(1)->take(5)->get();
        $list2 = $db->table('test')->having('id','>',3)->offset(2)->limit(5)->get();
        dump($list);
        dump($list2);
    }
    //带参数的条件语句,第二个闭包会在第一个闭包为false的时候执行,可以用于判断是否有指定的值执行不同的查询。
    public function select_when(){
        $id = 2;
        $db = DB::connection('study');
        $list = $db->table('test')->when($id ,function($query){
            return false;
        }, function($query) use ($id){
            return $query->where('id','>',$id);
        })->get();
        dump($list);
    }
    //插入数据
    public function insertDB(){
        $db = DB::connection('study');
        $re = $db->table('test')->insert(['name'=>'zhangsan','age'=>'21']);//插入数据
        dump($re);
        $id = $db->table('test')->insertGetId(
            ['name'=>'lisi','age'=>'21']
        );//插入数据同时获取自增ID
        dump($id);
        $re2 = $db->table('test')->insert([
            ['name'=>'wangwu','age'=>'21'],
            ['name'=>'zhaoliu','age'=>'21'],
        ]);//插入数据
        dump($re2);
    }

    //更新数据
    public function updateDB(){
        $db = DB::connection('study');
        $re = $db->table('test')->where('id',1)->update(['name'=>'zeo']);//普通修改
        dump($re);
        $re2 = $db->table('test')->where('id',2)->increment('age');//字段自增1
        dump($re2);
        $re3 = $db->table('test')->where('id',3)->increment('age',5);//字段自增5
        dump($re3);
        $re4 = $db->table('test')->where('id',4)->decrement('age');//字段自减1
        dump($re4);
        $re5 = $db->table('test')->where('id',5)->decrement('age',5);//字段自减5
        dump($re5);
        $re6 = $db->table('test')->where('id',6)->decrement('age',5,['name'=>'tttt']);//字段自减5,同时更新字段
        dump($re6);
    }

    //删除数据
    public function deleteDB(){
        $db = DB::connection('study');
        $re = $db->table('test')->where('id','>',10)->delete();//删除数据
        dump($re);
    }

    //清空数据
    public function truncateDB(){
        $db = DB::connection('study');
        $re = $db->table('test')->truncate();
        dump($re);
    }

    //分页与简单分页
    public function paginateDB(){
        //常规分页
        $db = DB::connection('study');
        $re = $db->table('test')->paginate(5);
        dump($re);
        dump($re->links());
        //简单分页
        $re2 = $db->table('test')->simplePaginate(5);
        dump($re2);
        dump($re2->links());
    }
}
?>