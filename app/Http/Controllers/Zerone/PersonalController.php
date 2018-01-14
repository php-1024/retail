<?php
namespace App\Http\Controllers\Tooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ToolingAccount;
use App\Libraries\ZeroneLog\ToolingLog;
use App\Models\ToolingOperationLog;
use App\Models\ToolingLoginLog;

class PersonalController extends Controller{
    //个人中心——个人资料
    public function personal(Request $request){
        dd('个人中心——个人资料');
    }

    //个人中心——登录密码修改
    public function password_edit(Request $request){
        dd('个人中心——登录密码修改');
    }
    //个人中心——安全密码设置
    public function security_password(Request $request){
        dd('个人中心——安全密码设置');
    }
    //个人中心——我的操作日志
    public function operation_log(Request $request){
        dd('个人中心——我的操作日志');
    }
    //个人中心——我的登录日志
    public function login_log(Request $request){
        dd('个人中心——我的登录日志');
    }
}
?>