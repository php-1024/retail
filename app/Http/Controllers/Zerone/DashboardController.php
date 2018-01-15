<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use Session;
use App\Models\Statistics;


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
        $zerone_all = Statistics::all();//获取统计数据
        $where = [];
        if($admin_data['id']<>1){   //不是超级管理员的时候，只查询自己相关的数据
            $where = [
                ['account_id',$admin_data['id']]
            ];
        }
        $login_log_list = LoginLog::getList($where,10,'id');//登录记录
        $operation_log_list = OperationLog::getList($where,10,'id');//操作记录
        return view('Zerone/Dashboard/display',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'login_log_list'=>$login_log_list,'operation_log_list'=>$operation_log_list,'zerone_all'=>$zerone_all]);
    }


    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>