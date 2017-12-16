<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use DB;
class SqlBasicController extends Controller{
    //Laravel数据库基本用法
    public function insertDb(){
        $db = new DB();
        $db = $db::connection('study');
        for($i = 0 ; $i<10; $i++){
            $db->insert("insert into test (name) VALUES (?)",['test'.$i]);
        }
    }
}
?>