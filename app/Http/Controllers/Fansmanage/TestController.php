<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/9
 * Time: 15:41
 */

namespace App\Http\Controllers\Fansmanage;


use App\Http\Controllers\Controller;
use App\Models\FansmanageUser;
use App\Models\Label;
use App\Models\UserLabel;

class TestController extends Controller
{
    public function test()
    {
        // 获取粉丝列表
        $list = FansmanageUser::getPaginage([['fansmanage_id', 5]], '', '10', 'id');

        dd($list);

//        $model = FansmanageUser::with('userOrigin')->with('user')->with('userRecommender')->with('userInfo')->with(['userLabel' => function ($query) {
//            return $query->select("label_id");
//        }]);


        $model = FansmanageUser::with('userOrigin')->with(['userLabel' => function ($query) {
            $query->select("label_id", "user_id");
        }, 'userOrigin' => function ($query) {
            $query->select("origin_id", "user_id");
        }]);


//        Post::with(array('user'=>function($query){
//            $query->select('id','username');
//        }))->get();

        if (!empty($field)) {
            $model->select($field);
        }
        if (!empty($user_id)) {
            $model->where(['user_id' => $user_id]);
        }
        $test = $model->where(['fansmanage_id' => 5])->orderBy("id", "DESC")->paginate(10);
        dump($test);
    }
}