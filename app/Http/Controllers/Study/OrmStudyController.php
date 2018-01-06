<?php
namespace App\Http\Controllers\Study;
use App\Http\Controllers\Controller;
use App\Models\Study\Test;
use App\Models\Study\TestSex;
use App\Models\Study\TestComment;
use App\Models\Study\User;
use App\Models\Study\Role;
use App\Models\Study\Province;
use App\Models\Study\City;
use App\Models\Study\Area;

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

    //插入|保存数据
    public function ins_save(){
        $id = 1;
        $data = ['name'=>'helloworld','age'=>99];
        $re = Test::ins_save($data,$id);
        dump($re);
    }
    //批量更新数据
    public function do_update(){
        $whereparam = [
           ['id','>','1'],
        ];
        $data = ['created_at'=>time(),'updated_at'=>time()];
        $re = Test::do_update($whereparam,$data);
        dump($re);
    }
    //删除
    public function do_delete(){
        $id = 11;
        $re = Test::select_delete($id);
        dump($re);
        $id = 11;
        $re = Test::do_delete($id);
        dump($re);
    }

    //ORM关联一对一的关系
    public function one_one(){
        $test = new Test();
        $row = $test->getSex();

        dump($row);
        dump($row->sex);

        $sex = new TestSex();
        $row2 = $sex->getUser();
        dump($row2);
        dump($row2->name);
    }

    //ORM关联一对多的模型;
    public function one_many(){
        $test = new Test();
        $list = $test->getComment();
        dump($list);
        foreach($list as $key=>$val){
            dump($val->comment_value);
        }
        $comment = new TestComment();
        $row2 = $comment->getUser();
        dump($row2);
        dump($row2->name);
    }

    //ORM关联多对多模型 ， 通过关系表关联两张表
    public function many_many(){
        $user = new User();
        $list = $user->getRoles();
        dump($list);

        $role = new Role();
        $list2 = $role->getUsers();
        dump($list2);
    }

    //ORM关联远程一对多模型 ， 通过关系表关联两张表
    public function one_through_many(){
        $province = new Province();
        $city = new City();

        $re1 = $province->getCitys();
        dump($re1);

        $re2 = $province->getAreas();
        dd($re2);

        $re3 = $city->getAreas();
        dump($re3);
    }

    //多态关联，多态多对多关联，作用不大，暂时略过

    //关联查询
    public function orm_search(){
        $user = new User();
        $list = $user->searchRoles();
        dump($list);

        //查询存在用户与角色关系的数据
        $list = $user::has('roles')->get();
        foreach($list as $key=>$val){
            dump($val->roles);
        }
    }
}
?>