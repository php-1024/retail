<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\Warzone;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Session;
class SystemController extends Controller{
    //添加服务商
    public function display(Request $request){
        Session::put('proxy_account_id','');

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
    public function select_proxy(Request $request){
        $organization_id = $request->input('organization_id');//中间件产生的管理员数据参数
        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
        if(!empty($account_info)){
            //重新生成缓存的登录信息
            $admin_data = [
                'id'=>$account_info->id,    //用户ID
                'account'=>$account_info->account,//用户账号
                'organization_id'=>$account_info->organization_id,//组织ID
                'is_super'=>$account_info->is_super,//是否超级管理员
                'parent_id'=>$account_info->parent_id,//上级ID
                'parent_tree'=>$account_info->parent_tree,//上级树
                'deepth'=>$account_info->deepth,//账号在组织中的深度
                'mobile'=>$account_info->mobile,//绑定手机号
                'safe_password'=>$account_info->safe_password,//安全密码
                'account_status'=>$account_info->status,//用户状态
                'super_id' => '2' //超级管理员进入后切换身份用
            ];
            Session::put('proxy_account_id',encrypt($account_info->id));//存储登录session_id为当前用户ID
            //构造用户缓存数据
            if(!empty( $account_info->account_info->realname)) {
                $admin_data['realname'] = $account_info->account_info->realname;
            }else{
                $admin_data['realname'] = '未设置';
            }
            if(!empty($account_info->account_roles)) {
                foreach ($account_info->account_roles as $key => $val) {
                    $account_info->role = $val;
                }
                $admin_data['role_name'] = $account_info->role->role_name;
            }else{
                $admin_data['role_name'] = '角色未设置';
            }
            \ZeroneRedis::create_proxy_account_cache(1,$admin_data);//生成账号数据的Redis缓存
            \ZeroneRedis::create_proxy_menu_cache(1);//生成对应账号的系统菜单
            return response()->json(['data' => '操作成功', 'status' => '0']);
        }else{
            return response()->json(['data' => '操作失败', 'status' => '1']);
        }
    }
    //退出登录
    public function quit(Request $request){
        Session::put('proxy_account_id','');
        return redirect('proxy/login');
    }
}
?>