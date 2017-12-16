<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use DB;
class SqlBasicController extends Controller{
    //Laravel数据库基本用法
    public function insertDb(){
        $db = new DB();

        for($i = 1 ; $i<=10; $i++){
            $db::connection('study')->insert("insert into study_test (name) VALUES (?)",['test'.$i]);
        }
    }
}
?>