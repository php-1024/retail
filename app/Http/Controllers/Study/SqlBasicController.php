<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use DB;
class SqlBasicController extends Controller{
    //Laravel数据库基本用法插入
    public function insertDb(){
        for($i = 1 ; $i<=10; $i++){
            DB::connection('study')->insert("insert into study_test (name) VALUES (?)",['test'.$i]);
        }
    }
    //Laravel数据库基本用法查询
    public function selectDb(){
        $list = DB::connection('study')->select('select * from study_test where id > :id',[':id'=>3]);
        dump($list);
    }
}
?>