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
    public function display()
    {
        return view('Zerone/Dashboard/display');
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>