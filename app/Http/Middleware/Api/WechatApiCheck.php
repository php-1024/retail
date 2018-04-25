<?php
/**
 * 检测是否登录的中间件
 */

namespace App\Http\Middleware\Api;

use App\Models\Account;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class WechatApiCheck
{
    public function handle($request, Closure $next)
    {
        // 获取当前的页面路由
        $route_name = $request->path();
        switch ($route_name) {
            /*****登录*****/
            case "api/wechatApi/store_list"://检测店铺列表提交数据
                $re = $this->checkTokenAndStoreList($request);
                return self::format_response($re, $next);
                break;
            /****登录****/
        }
        return $next($request);
    }


    /******************************复合检测*********************************/

    /**
     * 检测token值 And 店铺列表提交数据
     */
    public function checkTokenAndStoreList($request)
    {
        $re = $this->checkToken($request);//判断Token值是否正确
        if ($re['status'] == '0') {
            return $re;
        } else {
            $re2 = $this->checkStoreList($re['response']);//检测数据提交
            if ($re2['status'] == '0') {
                return $re2;
            } else {
                return self::res(1, $re2['response']);
            }
        }
    }



    /******************************单项检测*********************************/


    /**
     * 店铺列表数据提交检测
     */
    public function checkStoreList($request)
    {
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['msg' => '商户id不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('lat'))) {
            return self::res(0, response()->json(['msg' => '微信地理位置纬度不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('lng'))) {
            return self::res(0, response()->json(['msg' => '微信地理位置经度不能为空', 'status' => '0', 'data' => '']));
        }
        return self::res(1, $request);
    }






    /**
     * 进入所有页面的前置流程
     */
    public function checkToken($request)
    {
        return self::res(1, $request);
    }


    /**
     * 工厂方法返回结果
     */
    public static function res($status, $response)
    {
        return ['status' => $status, 'response' => $response];
    }

    /**
     * 格式化返回值
     */
    public static function format_response($re, Closure $next)
    {
        if ($re['status'] == '0') {
            return $re['response'];
        } else {
            return $next($re['response']);
        }
    }

}

?>