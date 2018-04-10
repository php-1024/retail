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
use App\Models\User;
use App\Models\UserLabel;

class TestController extends Controller
{
    public function test()
    {
        // 获取粉丝列表
//        $list = FansmanageUser::getPaginage([['fansmanage_id', 5]], '', '10', 'id');
//        $model = FansmanageUser::with('userOrigin')->with(['userLabel' => function ($query) {
//            $query->select("label_id", "user_id");
//        }, 'userOrigin' => function ($query) {
//            $query->select("origin_id", "user_id");
//        }]);
//        dd($list);

//        $model = FansmanageUser::with('userOrigin')->with('user')->with('userRecommender')->with('userInfo')->with(['userLabel' => function ($query) {
//            return $query->select("label_id");
//        }]);


        $model = FansmanageUser::with(['user', 'userOrigin', "userRecommender" => function($query){
            $query->select("recommender_id","user_id");
        }, 'userInfo' => function ($query) {
            $query->select("id","nickname","head_imgurl","user_id");
        }, 'userLabel' => function ($query) {
            $query->select("label_id","user_id");
        }]);
        $test = $model->where(['fansmanage_id' => 5])->orderBy("id", "DESC")->paginate(10);

        $test_info = $test->toArray();


        $recommender_id = User::select("id")->where(['id'=> 2])->first();

        dump($test_info["data"][0]);
        dump($test_info["data"][0]["user_info"]);
        dump($test_info["data"][0]["user_recommender"]["recommender_id"]);
//        dump($test_info["data"][0]["userLabel"]);
    }
}