<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Api;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class AndroidApiCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录*****/
            case "api/androidapi/login"://检测登入提交数据
                $this->checkLogin($request);
                break;
            /****登录****/
            case "api/androidapi/goodslist"://检测登入提交数据
                $this->checkGoodsListData($request);
                break;

        }
        return $next($request);
    }


    /**
     * 普通页面检测用户是否登录
     */
    public function checkLogin($request){
        if (empty($request->input('account'))) {
            return self::res(0, response()->json(['mas' => '请输入用户名', 'status' => '0']));
        }
        if (empty($request->input('password'))) {
            return self::res(0, response()->json(['mas' => '请输入密码', 'status' => '0']));
        }
        return self::res(1,$request);
    }

    /**
     * 普通页面检测商品列表接口数据是否为空
     */
    public function checkGoodsListData($request){
        if (empty($request->input('account_id'))) {
            return self::res(0, response()->json(['mas' => '用户id不能为空', 'status' => '0']));
        }
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['mas' => '店铺id不能为空', 'status' => '0']));
        }
        if (empty($request->input('timestamp'))) {
            return self::res(0, response()->json(['mas' => '当前时间戳不能为空', 'status' => '0']));
        }
        if (empty($request->input('token'))) {
            return self::res(0, response()->json(['mas' => '店铺令牌不能为空', 'status' => '0']));
        }

        return self::res(1,$request);
    }

    //工厂方法返回结果
    public static function res($status,$response){
        return ['status'=>$status,'response'=>$response];
    }
    //格式化返回值
    public static function format_response($re,Closure $next){
        if($re['status']=='0'){
            return $re['response'];
        }else{
            return $next($re['response']);
        }
    }
}
?>