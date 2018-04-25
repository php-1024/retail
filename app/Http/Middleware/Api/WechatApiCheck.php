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
        $route_name = $request->path();//获取当前的页面路由
        switch ($route_name) {
            /*****登录*****/
            case "api/androidapi/login"://检测登入提交数据
                $re = $this->checkLogin($request);
                return self::format_response($re, $next);
                break;
            /****登录****/
        }
        return $next($request);
    }


    /******************************复合检测*********************************/

    /**
     * 检测token值 And 商品列表接口店铺id是否为空
     */
    public function checkTokenAndGoodsCategoryData($request)
    {
        $re = $this->checkToken($request);//判断Token值是否正确
        if ($re['status'] == '0') {
            return $re;
        } else {
            $re2 = $this->checkRetailId($re['response']);//检测数据提交
            if ($re2['status'] == '0') {
                return $re2;
            } else {
                return self::res(1, $re2['response']);
            }
        }
    }


    /******************************单项检测*********************************/

    /**
     * 普通页面检测用户是否登录
     */
    public function checkLogin($request)
    {
        if (empty($request->input('account'))) {
            return self::res(0, response()->json(['msg' => '请输入用户名', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('password'))) {
            return self::res(0, response()->json(['msg' => '请输入密码', 'status' => '0', 'data' => '']));
        }
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