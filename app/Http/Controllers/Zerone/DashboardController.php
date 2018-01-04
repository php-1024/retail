<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Models\ToolingAccount;
use App\Models\ToolingErrorLog;
use App\Models\ToolingLoginLog;
use Session;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller{
    /*
     * 登陆页面
     */
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        dump($menu_data);
        dump($son_menu_data);
        dump($admin_data);
        return view('Zerone/Dashboard/display');
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>