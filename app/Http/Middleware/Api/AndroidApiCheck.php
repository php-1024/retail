<?php
/**
 * 检测是否登录的中间件
 */
namespace App\Http\Middleware\Api;
use App\Models\Account;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class AndroidApiCheck{
    public function handle($request,Closure $next){
        $route_name = $request->path();//获取当前的页面路由
        switch($route_name){
            /*****登录*****/
            case "api/androidapi/login"://检测登入提交数据
                $re = $this->checkLogin($request);
                return self::format_response($re, $next);
                break;
            /****登录****/
            case "api/androidapi/goodscategory"://检测Token和商品分类数据
                $re = $this->checkTokenAndGoodsCategoryData($request);
                return self::format_response($re, $next);
                break;
            case "api/androidapi/goodslist"://检测Token和商品列表数据
                $re = $this->checkTokenAndGoodsListData($request);
                return self::format_response($re, $next);
                break;
            case "api/androidapi/order_check"://检测Token和订单提交数据
                $re = $this->checkTokenAndOrderCheck($request);
                return self::format_response($re, $next);
                break;
        }
        return $next($request);
    }


    /******************************复合检测*********************************/

    /**
     * 检测token值 And 商品列表接口店铺id是否为空
     */
    public function checkTokenAndGoodsCategoryData($request){
        $re = $this->checkToken($request);//判断Token值是否正确
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkGoodsCategoryData($re['response']);//检测数据提交
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    /**
     * 检测token值 And 商品列表接口店铺id是否为空
     */
    public function checkTokenAndGoodsListData($request){
        $re = $this->checkToken($request);//判断Token值是否正确
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkGoodsListData($re['response']);//检测数据提交
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }
    /**
     * 检测token值 And 商品列表接口店铺id是否为空
     */
    public function checkTokenAndOrderCheck($request){
        $re = $this->checkToken($request);//判断Token值是否正确
        if($re['status']=='0'){
            return $re;
        }else{
            $re2 = $this->checkOrderCheck($re['response']);//检测数据提交
            if($re2['status']=='0'){
                return $re2;
            }else{
                return self::res(1,$re2['response']);
            }
        }
    }

    /******************************单项检测*********************************/
    /**
     * 普通页面检测用户是否登录
     */
    public function checkLogin($request){
        if (empty($request->input('account'))) {
            return self::res(0, response()->json(['msg' => '请输入用户名', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('password'))) {
            return self::res(0, response()->json(['msg' => '请输入密码', 'status' => '0', 'data' => '']));
        }
        return self::res(1,$request);
    }

    /**
     * 普通页面检测商品列表接口数据是否为空
     */
    public function checkGoodsCategoryData($request){
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['msg' => '店铺id不能为空', 'status' => '0', 'data' => '']));
        }
            return self::res(1,$request);
    }

    /**
     * 普通页面检测商品列表接口数据是否为空
     */
    public function checkGoodsListData($request){
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['msg' => '店铺id不能为空', 'status' => '0', 'data' => '']));
        }
        return self::res(1,$request);
    }

    /**
     * 普通页面检测商品列表接口数据是否为空
     */
    public function checkOrderCheck($request){
        if (empty($request->input('organization_id'))) {
            return self::res(0, response()->json(['msg' => '店铺id不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty(json_decode($request->input('goodsdata')))) {
            echo 1;exit;
            return self::res(0, response()->json(['msg' => '提交的数据不能为空', 'status' => '0', 'data' => '']));
        }
        return self::res(1,$request);
    }


    /**
     * 检测token值
     */
    public function checkToken($request){
        if (empty($request->input('account_id'))) {
            return self::res(0, response()->json(['msg' => '用户id不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('timestamp'))) {
            return self::res(0, response()->json(['msg' => '当前时间戳不能为空', 'status' => '0', 'data' => '']));
        }
        if (empty($request->input('token'))) {
            return self::res(0, response()->json(['msg' => 'token值不能为空', 'status' => '0', 'data' => '']));
        }
        list($t1, $t2) = explode(' ', microtime());
        $time = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
//        if($time - $request->input('timestamp')>120000){
//            return self::res(0, response()->json(['msg' => '访问超时', 'status' => '0', 'data' => '']));
//        }
        $account_id = $request->account_id;//用户账号id
        $token = $request->token;//店铺令牌
        $timestamp = $request->timestamp;//当前时间戳

        $data = Account::where([['id',$account_id]])->first();//查询用户信息
        if(empty($data)){
            return self::res(0, response()->json(['msg' => '用户不存在', 'status' => '0', 'data' => '']));

        }
        $sort = array($data['account'],$timestamp);
        ksort($sort);//字典排序
        $store_token = '';
        foreach($sort as $key=>$value){//拼接token
            $store_token .= $value;
        }

        $store_token = base64_encode($store_token.$data['uuid']).'lingyi2018';//第一次加密
        $store_token = md5($store_token);//第二次加密
        if($store_token !=$token){
            return self::res(0, response()->json(['msg' => 'token值不正确,无权访问', 'status' => '0', 'data' => '']));
        }
        return self::res(1,$request);
    }

    /**
     * 工厂方法返回结果
     */
    public static function res($status,$response){
        return ['status'=>$status,'response'=>$response];
    }

    /**
     * 格式化返回值
     */
    public static function format_response($re,Closure $next){
        if($re['status']=='0'){
            return $re['response'];
        }else{
            return $next($re['response']);
        }
    }

}
?>