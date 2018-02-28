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
    public function display()
    {
        return view('Branch/Display/display');
    }
}

?>