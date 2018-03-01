<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Models\Account;
use App\Models\ErrorLog;
use App\Models\LoginLog;
use Session;

class DisplayController extends Controller
{
    /*
     * 登录页面
     */
    public function display(Request $request)
    {
        $key = config("app.branch_encrypt_key");//获取加密盐（分店专用）
        $password = 'admin';
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji" . $encrypted . $key);//加密密码第二重
        dump($encryptPwd);
        dump($request);
//        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
//        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
//        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
//        $route_name = $request->path();                     //获取当前的页面路由
        return view('Branch/Display/display');
    }
}

?>