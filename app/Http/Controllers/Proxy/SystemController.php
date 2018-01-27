<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\Warzone;
use Illuminate\Http\Request;
use Session;
class SystemController extends Controller{
    //添加服务商
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        if($admin_data['super_id'] == 1){
            $listOrg = Organization::getPaginage([['program_id','2']],20,'id');
            foreach ($listOrg as $k=>$v){
                $zone_id = $v['warzoneProxy']['zone_id'];
                $listOrg[$k]['zone_name'] = Warzone::where([['id',$zone_id]])->pluck('zone_name')->first();
            }
            return view('Proxy/System/select_proxy',['listOrg'=>$listOrg]);
        }else{

            $where = [];
            if($admin_data['id']<>1){   //不是超级管理员的时候，只查询自己相关的数据【后期考虑转为查询自己及自己管理的下级人员的所有操作记录】
                $where = [['account_id',$admin_data['id']]];
            }
            $login_log_list = LoginLog::getList($where,10,'id');//登录记录
            $operation_log_list = OperationLog::getList($where,10,'id');//操作记录
            return view('Proxy/System/index',['login_log_list'=>$login_log_list,'operation_log_list'=>$operation_log_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }

    //退出登录
    public function quit(Request $request){
        Session::put('proxy_account_id','');
        return redirect('proxy/login');
    }
}
?>