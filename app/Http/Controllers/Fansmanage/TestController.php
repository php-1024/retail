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
use App\Models\UserInfo;
use DB;
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
        \DB::enableQueryLog();
        $search = "";

        $model = FansmanageUser::select("store_id", "fansmanage_id", "user_id", "open_id", "mobile")->with(["userOrigin", "user" => function ($query) use ($search) {
            $query->select("id", "account");
//            // 关键字搜索
            if (!empty($search)) {
                $query->where("account", 'like', "'%$search%'");
            }
        }, "userRecommender" => function ($query) {
            $query->select("recommender_id", "user_id");
        }, "userInfo" => function ($query) {
            $query->select("id", "nickname", "head_imgurl", "user_id");
        }, "userLabel" => function ($query) {
            $query->select("label_id", "user_id");
        }]);


        $list = $model->where(['fansmanage_id' => 5])->orderBy("id", "DESC")->paginate(10);
//        dump(\DB::getQueryLog());

//        dump(\DB::enableQueryLog());
//        $sql = 'select * from `rooms` where `rooms`.`project_id` = 3';
//        $resultSql = \DB::table('DB::raw($test as room')->toSql();


//        $list = $list->toArray();

        $list_merge = [];
        // 处理数据
        foreach ($list as $key => $value) {
            if (!empty($value["user"])) {
                dump(1);
                $list_merge = $value->toArray();
//                // 微信昵称
//                $list[$key]['nickname'] = $value["userInfo"]['nickname'];
//                // 微信头像
//                $list[$key]['head_imgurl'] = $value["userInfo"]['head_imgurl'];
//                // 获取推荐人信息
//                // 推荐人id
//                $recommender_info = User::select("id")->where(['id' => 2])->first();
//                // 推荐人名称
//                $userInfo = UserInfo::select("nickname")->where(['user_id' => $recommender_info['id']])->first();
//                $list[$key]['recommender_name'] = $userInfo["nickname"];
//                // 粉丝对应的标签id
//                $list[$key]['label_id'] = $value["userLabel"]['label_id'];

                $list_merge[$key]['nickname'] = $value["userInfo"]['nickname'];
                $list_merge[$key]['head_imgurl'] = $value["userInfo"]['head_imgurl'];
                $recommender_info = User::select("id")->where(['id' => $value["userRecommender"]["recommender_id"]])->first();
                $userInfo = UserInfo::select("nickname")->where(['user_id' => $recommender_info['id']])->first();
                $list_merge[$key]['recommender_name'] = $userInfo["nickname"];
                $list_merge[$key]['label_id'] = $value["userLabel"]['label_id'];
            }else{
                dump(2);
            }
        }

        dump($list_merge);
    }
}