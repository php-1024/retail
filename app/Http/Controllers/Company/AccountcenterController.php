<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Province;
use App\Models\Setup;
use App\Models\Warzone;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\WarzoneProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Statistics;
use App\Models\OrganizationRole;

class DashboardController extends Controller{

    //系统管理首页
    public function display(Request $request)
    {
        dump($request);
        dd('登陆成功！');
        return view('Zerone/Dashboard/display',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'login_log_list'=>$login_log_list,'operation_log_list'=>$operation_log_list,'zerone'=>$zerone]);
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>