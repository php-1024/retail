<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use App\Models\Study\Test;
class OrmStudyController extends Controller{
    //调用model里的all方法获取所有数据
    public function getAll(){
        $list = Test::get_all();
        dump($list);
    }
    //调用model里的get方法获取列表
    public function getList(){
        $list = Test::get_list();
        dump($list);
    }
    //调用model里的获取单条数据
    public function getOne(){

    }
}
?>