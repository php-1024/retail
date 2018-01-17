<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Province;
use App\Models\Setup;
use App\Models\Warzone;
use App\Models\Module;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\WarzoneProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $zone_name = $request->input('zone_name');//搜索时输入的战区名称
        $warzone = Warzone::getPaginage([[ 'zone_name','like','%'.$zone_name.'%' ]],10,'id');
        return view('Zerone/Warzone/display',['zone_name'=>$zone_name,'warzone'=>$warzone,'admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //战区管理编辑弹出
    public function warzone_edit(Request $request){
        $zone_name = $request->input('zone_name');//搜索时输入的战区名称
        $warzone = Warzone::getPaginage([[ 'zone_name','like','%'.$zone_name.'%' ]],10,'id');
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

        $zone_id = $request->input('id');
        $zone_info = Warzone::getPaginage([[ 'id','like','%'.$zone_id.'%' ]],10,'id');
        return view('Zerone/Warzone/warzone_edit',['zone_info'=>$zone_info,'new_province_name'=>$new_province_name]);
    }
    //战区管理编辑数据提交
    public function warzone_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $zone_name = $request->input('zone_name');//战区名称
        $province_id = $request->input('province_id');//包含省份ID（array）
        $zone_id = $request->input('zone_id');//战区ID
        if(empty($province_id)){
            return response()->json(['data' => $zone_id.'选择战区包含省份！', 'status' => '1']);
        }
        DB::beginTransaction();
        try {
            Warzone::WarzoneEdit([['id', $zone_id]], ['zone_name' => $zone_name]);//修改战区名称
            //此方法行不通，先删除原有战区ID的数据然后在添加新的数据
            WarzoneProvince::WarzoneProvinceDelete($zone_id);
            WarzoneProvince::WarzoneProvinceEdit($province_id,$zone_id);
            //添加操作日志
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'编辑了战区：'.$zone_name);//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            dump($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '编辑战区失败，请检查！', 'status' => '0']);
        }
        return response()->json(['data' => '编辑战区成功', 'status' => '1']);
    }

    //战区管理添加战区弹出
    public function warzone_add(Request $request){
        $province = Province::getpluck('id');//获取所有战区可选省份
        foreach ($province as $key=>$val){
            $all_province_name[$val->id] = $val->province_name;
        }
        $zone_id = $request->input('id');
        $zone_info = Warzone::getPaginage([[ 'id','like','%'.$zone_id.'%' ]],10,'id');
        return view('Zerone/Warzone/warzone_add',['zone_info'=>$zone_info,'all_province_name'=>$all_province_name]);
    }
    //战区管理编辑数据提交
    public function warzone_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $zone_name = $request->input('zone_name');//战区名称
        $province_id = $request->input('province_id');//包含省份ID（array）
        $zone_id = Warzone::WarzoneAdd($zone_name);//添加战区名称并且返回添加的id
        echo $zone_id['id'];
//        DB::beginTransaction();
//        try {
//            Warzone::WarzoneAdd($zone_name);//添加战区名称
//            WarzoneProvince::WarzoneProvinceEdit($province_id,$zone_id);//添加战区包含省份
//            //添加操作日志
//            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了战区：'.$zone_name);//保存操作记录
//            DB::commit();
//        } catch (\Exception $e) {
//            dump($e);
//            DB::rollBack();//事件回滚
//            return response()->json(['data' => '添加战区失败，请检查！', 'status' => '0']);
//        }
//        return response()->json(['data' => '添加战区成功！', 'status' => '1']);
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

    /*
     * 系统人员结构
     */
    public function structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = 1;//当前组织ID，零壹管理平台组织只能为1
        //获取重Admin开始的的所有人员
        $list = Account::getList([['organization_id',$organization_id],['parent_tree','like','0,1,%']],0,'id','asc')->toArray();
        //根据获取的人员组成结构树
        $structure = $this->create_structure($list,1);
        return view('Zerone/Dashboard/structure',['structure'=>$structure ,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 递归生成人员结构的方法
     * $list - 结构所有人员的无序列表
     * $id - 上级ID
     */
    private function create_structure($list,$id){
        $structure = '';
        foreach($list as $key=>$val){
            if($val['parent_id'] == $id) {
                unset($list[$key]);
                $val['sonlist'] = $this->create_structure($list, $val['id']);
                //$arr[] = $val;
                $structure .= '<ol class="dd-list"><li class="dd-item" data-id="' . $val['id'] . '">' ;
                $structure .= '<div class="dd-handle">';
                $structure .= '<span class="pull-right">创建时间：'.date('Y-m-d,H:i:s',$val['created_at']).'</span>';
                $structure .= '<span class="label label-info"><i class="fa fa-user"></i></span>';
                $structure .=  $val['account']. '-'.$val['account_info']['realname'];
                if(!empty($val['account_roles'])){
                    $structure.='【'.$val['account_roles'][0]['role_name'].'】';
                }
                $structure .= '</div>';
                $son_menu = $this->create_structure($list, $val['id']);
                if (!empty($son_menu)) {
                    $structure .=  $son_menu;
                }
                $structure .= '</li></ol>';
            }
        }
        return $structure;
    }
    //退出登录
    public function quit(Request $request){
        Session::put('zerone_account_id','');
        return redirect('zerone/login');
    }
}
?>