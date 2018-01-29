<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationProxyinfo;
use App\Models\Warzone;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $organization_id = $admin_data['organization_id'];//服务商id
            $acc_num = Account::where([['organization_id',$organization_id]])->count();//查询服务商人数
            $org_num = Organization::where([['parent_id',$organization_id]])->count();//查询服务商附属商务个数
            return view('Proxy/System/index',['login_log_list'=>$login_log_list,'operation_log_list'=>$operation_log_list,'acc_num'=>$acc_num,'org_num'=>$org_num,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }
    //超级管理员选择服务商
    public function select_proxy(Request $request){
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
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
                'safe_password'=>$admin_this['safe_password'],//安全密码-超级管理员
                'account_status'=>$account_info->status,//用户状态
                'super_id' => '2' //超级管理员进入后切换身份用
            ];
            Session::put('proxy_account_id',encrypt($admin_this['id']));//存储登录session_id为当前用户ID
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
            return response()->json(['data' => '操作成功', 'status' => '1']);

        }else{
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
    }

    //公司信息设置
    public function proxy_info(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        $listorg = Organization::getOneProxy([['id',$organization_id]]);

        return view('Proxy/System/proxy_info',['listorg'=>$listorg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //公司信息设置
    public function proxy_info_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $id = $request->input('id');//服务商id
        $realname = $request->input('realname');//负责人
        $organization_name = $request->input('organization_name');//服务商名称
        $idcard = $request->input('idcard');//负责人身份证
        $mobile = $request->input('mobile');//负责人手机号
        DB::beginTransaction();
        try{
            $list = Organization::getOneProxy(['id'=>$id]);
            $acc = Account::getOne(['organization_id'=>$id,'parent_id'=>'1']);
            $account_id = $acc['id'];
            if($list['organization_name']!=$organization_name){
                Organization::editOrganization([['id',$id]], ['organization_name'=>$organization_name]);//修改服务商表服务商名称
            }
            if($list['mobile']!=$mobile){
                OrganizationProxyinfo::editOrganizationProxyinfo([['organization_id',$id]], ['proxy_owner_mobile'=>$mobile]);//修改服务商表服务商手机号码
                Account::editAccount(['organization_id'=>$id],['mobile'=>$mobile]);//修改用户管理员信息表 手机号
            }
            if($list['organizationproxyinfo']['proxy_owner'] != $realname){
                OrganizationProxyinfo::editOrganizationProxyinfo([['organization_id',$id]],['proxy_owner'=>$realname]);//修改服务商用户信息表 用户姓名
                AccountInfo::editAccountInfo([['account_id',$account_id]],['realname'=>$realname]);//修改用户管理员信息表 用户名
            }

            if($acc['idcard'] != $idcard){
                AccountInfo::editAccountInfo([['account_id',$account_id]],['idcard'=>$idcard]);//修改用户管理员信息表 身份证号
                OrganizationProxyinfo::editOrganizationProxyinfo([['organization_id',$id]],['proxy_owner_idcard'=>$idcard]);//修改服务商信息表 身份证号
            }
            if($admin_data['super_id'] != 2) {
                //添加操作日志
                OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了服务商：' . $list['organization_name']);//保存操作记录
            }
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改失败', 'status' => '0']);
        }
        return response()->json(['data' => '修改成功', 'status' => '1']);

    }
    //退出登录
    public function switch_status(Request $request){
        return self::display($request);
    }
    //退出登录
    public function quit(Request $request){
        Session::put('proxy_account_id','');
        return redirect('proxy/login');
    }
}
?>