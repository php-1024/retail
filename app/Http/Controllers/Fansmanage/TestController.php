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
use App\Models\Organization;
use App\Models\Program;
use App\Models\UserInfo;
use App\Models\UserOrigin;
use DB;
use App\Models\Label;
use App\Models\User;
use App\Models\UserLabel;

class TestController extends Controller
{
    public function test()
    {
        $param["fansmanage_id"] = 1;
        // 用户id
        $param["user_id"] = 1;
        // 店铺公众号  openid
        $param["open_id"] = 1;

        $res = FansmanageUser::insertData($param, ["open_id" => 1]);
        var_dump($res);


//        $key = config("app.retail_encrypt_key");
//        // 密码加密
//        $password = 'admin';
//        $encrypted = md5($password);//加密密码第一重
//        $encryptPwd = md5("lingyikeji" . $encrypted . $key);//加密密码第二重
//        dd($encryptPwd);
//
//        $param_user_origin["user_id"] = 2;
//        $param_user_origin["fansmanager_id"] = 3;
//        $param_user_origin["store_id"] = 2;
//        $param_user_origin["status"] = "1";
//        $param_user_origin["invalid_time"] = 0;
//
//        // 保存源头数据
//        UserOrigin::insertData($param_user_origin, "update_create", ["fansmanager_id" => 3,"store_id" =>2,"user_id" => 2]);

//
//        $userInfo = UserInfo::getOneUserInfo([['user_id', 1]]);
//        $data['account'] = User::where(['id'=> 1])->value("account");
////        $data['account'] = User::where(['id'=> 1])->get(["account"]);
//        dump($data);

//        \DB::enableQueryLog();
//        $search = "100";

//        $model = FansmanageUser::select("fansmanage_user.store_id", "fansmanage_user.fansmanage_id", "fansmanage_user.user_id", "fansmanage_user.open_id", "fansmanage_user.mobile","user.account")->with(["userOrigin", "user" => function ($query) use ($search) {
//            $query->select("id", "account");
////            // 关键字搜索
//        }, "userRecommender" => function ($query) {
//            $query->select("recommender_id", "user_id");
//        }, "userInfo" => function ($query) {
//            $query->select("id", "nickname", "head_imgurl", "user_id");
//        }, "userLabel" => function ($query) {
//            $query->select("label_id", "user_id");
//        }])->leftJoin('user', 'fansmanage_user.user_id', '=', 'user.id');
//
//


//        $model = FansmanageUser::select("fansmanage_user.id", "fansmanage_user.store_id", "fansmanage_user.fansmanage_id", "fansmanage_user.user_id", "fansmanage_user.open_id", "fansmanage_user.mobile", "user.account")->with(["userOrigin", "user" => function ($query) use ($search) {
//            $query->select("id", "account");
//        }, "userRecommender" => function ($query) {
//            $query->select("recommender_id", "user_id");
//        }, "userInfo" => function ($query) {
//            $query->select("id", "nickname", "head_imgurl", "user_id");
//        }, "userLabel" => function ($query) {
//            $query->select("label_id", "user_id");
//        }])->leftJoin('user', 'fansmanage_user.user_id', '=', 'user.id');
//
//        if (!empty($search)) {
//            $model->where("account", 'like', "%$search%");
//        }
//        $res = $model->where(['fansmanage_id' => 5])->orderBy("id", "DESC")->paginate(10);
//        dump($res);
//        exit;


//        if (!empty($search)) {
//            $query->where("account", 'like', "%$search%");
//        }
//        $sub = Abc::where(..)->groupBy(..); // Eloquent Builder instance
//
//$count = DB::table( DB::raw("({$sub->toSql()}) as sub") )
//    ->mergeBindings($sub->getQuery()) // you need to get underlying Query Builder
//    ->count();

//        $list = $model->where(['fansmanage_id' => 5])->orderBy("id", "DESC")->paginate(10);
//
//
//        // 处理数据
//        foreach ($list as $key => $value) {
//            if (!empty($value["user"])) {
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
//            } else {
//                unset($list[$key]);
//            }
//        }
//        dump($list);
    }

    public function test2()
    {
        $res = Organization::getShopSimpleInfo(2);
        dd($res);
    }
}
