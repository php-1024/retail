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

    //调用model的paginate获取分页数据
    public function getPage(){
        $list = Test::get_paginate();
        dump($list);
    }

    //调用model里的获取单条数据
    public function getOne(){
        $row = Test::get_find();
        dump($row);
        $row2 = Test::get_first();
        dump($row2);
    }

    public function ins_save(){
        $id = 1;
        $data = ['name'=>'helloworld','age'=>99];
        $re = Test::ins_update($data,$id);
        dump($re);
    }

    public function do_update(){
        $whereparam = [
            'normal'=>['id','>','1'],
        ];

        $data = ['created_at'=>time(),'updated_at'=>time()];

        $re = Test::do_update($whereparam,$data);
        dump($re);
    }
}
?>