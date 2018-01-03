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
        echo "这里是零壹管理平台";
        //return view('Universal/Login/zerone_display');
    }
}
?>