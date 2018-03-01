<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
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
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        dump($request);
        return view('Branch/Display/display');
    }
}

?>