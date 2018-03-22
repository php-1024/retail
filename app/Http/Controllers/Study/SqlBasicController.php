<?php
/*
 * Laravel框架，数据库语句基本用法
 */
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SqlBasicController extends Controller{
    //Laravel数据库基本用法插入
    public function insertDb(){
        for($i = 1 ; $i<=10; $i++){
            DB::connection('study')->insert("insert into study_test (name) VALUES (?)",['test'.$i]);
        }
    }
    //Laravel数据库基本用法查询
    public function selectDb(){
        $list = DB::connection('study')->select("select * from study_test where id = :id",['id'=>2]);
        dump($list);
    }
    //Laravel数据库基本用法更新
    public function updateDb(){
        $res = DB::connection('study')->update("update study_test set name='test3update' where id = :id",['id'=>3]);
        dump($res);
    }
    //Laravel数据库基本用法删除
    public function deleteDb(){
        $res = DB::connection('study')->delete("delete from study_test where id = :id",['id'=>11]);
        dump($res);
    }
    //Laravel 执行一般查询语句
    public function statementDb(){
        $res = DB::connection('study')->statement("alter table study_test AUTO_INCREMENT=1");
        dump($res);
    }
    //Laravel 数据库事务的使用以及获取数据库操作日志
    public function transactionDb(){
        DB::connection('study')->enableQueryLog();//开启日志
        DB::beginTransaction();//开启事务
        try{
            DB::connection('study')->update("update study_test set name='test10update' where id = :id",['id'=>10]);
            DB::connection('study')->delete("delete from study_test where id > :id",['id'=>10]);
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
        }
        $queries = DB::connection('study')->getQueryLog();
        dump($queries);//打印操作记录
    }
}
?>