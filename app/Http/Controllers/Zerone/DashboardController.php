<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Setup;
use App\Models\Warzone;
use App\Models\Module;
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
    //参数设置展示
    public function setup(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $setup_list = Setup::get_all();
        return view('Zerone/Setup/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'setup_list'=>$setup_list]);
    }
    //参数设置编辑
    public function setup_edit_check(Request $request){
        $serviceurl = $request->input('serviceurl');//[serviceurl]服务商通道链接
        $merchanturl = $request->input('merchanturl');//[merchant]商户通道链接
        $depth = $request->input('depth');//[depth]人员构深度设置
        $serviceurl_deleted = $request->input('serviceurl_deleted');//是否开启服务商通道链接
        $merchanturl_deleted = $request->input('merchanturl_deleted');//是否开启商户通道链接
        if(empty($serviceurl_deleted)){
            $serviceurl_status = 0;
        }else{
            $serviceurl_status = 1;
        }
        if(empty($merchanturl_deleted)){
            $merchanturl_status = 0;
        }else{
            $merchanturl_status = 1;
        }
        Setup::editSetup([['id',1]],['cfg_value'=>$serviceurl]);        //修改保存服务商通道链接
        Setup::editSetup([['id',2]],['cfg_value'=>$merchanturl]);       //修改保存商户通道链接
        Setup::editSetup([['id',3]],['cfg_value'=>$depth]);             //修改保存人员构深度设置
        Setup::editSetup([['id',4]],['cfg_value'=>$serviceurl_status]); //修改保存服务商通道链接开启状态
        Setup::editSetup([['id',5]],['cfg_value'=>$merchanturl_status]);//修改保存服务商通道链接开启状态
        return response()->json(['data' => '系统参数修改成功！', 'status' => '1']);
    }
    //战区管理首页
    public function warzone(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $zone_name = $request->input('zone_name');
        $warzone = Warzone::getPaginage([[ 'zone_name','like','%'.$zone_name.'%' ]],1,'id');
        $province = Province::getpluck('id');
        foreach ($warzone as $key=>$val){
            foreach ($val->province as $kk=>$vv){
                $province_name[$vv->id] = $vv->province_name;
            }
        }
        foreach ($province as $key=>$val){
            $all_province_name[$val->id] = $val->province_name;
        }
        $new_province_name = array_diff($all_province_name,$province_name);

        return view('Zerone/Warzone/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'warzone'=>$warzone,'new_province_name'=>$new_province_name]);
    }
    //战区管理编辑弹出
    public function warzone_edit(Request $request){
        $zone_name = $request->input('zone_name');//战区名称
        $province_id = $request->input('province_id');//包含省份ID（array）
        if(empty($zone_name)){
            return response()->json(['data' => '请输入战区名称！', 'status' => '1']);
        }
        if(empty($province_id)){
            return response()->json(['data' => '选择战区包含省份！', 'status' => '1']);
        }
    }
    //功能模块列表
    public function module_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_name = $request->input('module_name');
        $search_data = ['module_name'=>$module_name];
        $list = Module::getPaginage([[ 'module_name','like','%'.$module_name.'%' ]],15,'id');
        dump($list);
        return view('Tooling/Module/module_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    /*
     * 所有操作记录
     */
    public function operation_log(Request $request)
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
        $operation_log_list = OperationLog::getPaginage($where,10,'id');//操作记录
        return view('Zerone/Log/operation_log',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'operation_log_list'=>$operation_log_list]);
    }
    /*
     * 所有登录记录
     */
    public function login_log(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $where = [];
        if($admin_data['id']<>1){   //不是超级管理员的时候，只查询自己相关的数据
            $where = [
                ['account_id',$admin_data['id']]
            ];
        }
        $login_log_list = LoginLog::getPaginage($where,10,'id');//登录记录
        return view('Zerone/Log/login_log',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'login_log_list'=>$login_log_list]);
    }
    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>