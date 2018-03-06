<?php
/**
 *餐饮分店管理系统
 * 登录界面
 **/

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
use App\Models\Organization;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Session;

class DisplayController extends Controller
{
    /*
     * 登录页面
     */
    public function display(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');            //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');    //中间件产生的管理员数据参数
        $route_name = $request->path();                         //获取当前的页面路由

        //只查询自己相关的数据
        $where = [
            ['account_id',$admin_data['id']],
            ['program_id','5'], //查询program_id(5)餐饮管理系统的操作日志
            ['organization_id',$admin_data['organization_id']]
        ];
        $login_log_list = LoginLog::getList($where,10,'id','DESC');
        dump($login_log_list);
        if($admin_data['is_super'] == 1 && $admin_data['organization_id'] == 0){    //如果是超级管理员并且组织ID等于零则进入选择组织页面
            return redirect('branch/branch_list');
        }
        $organization = Organization::getOneCompany(['id' => $admin_data['organization_id']]);
        if (empty($admin_data['safe_password'])){           //先设置安全密码
            return redirect('branch/account/password');
        }else{
            return view('Branch/Display/display',['login_log_list'=>$login_log_list,'organization'=>$organization,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }

    //分店列表（超级管理员使用）
    public function branch_list(Request $request)
    {
        $admin_data = $request->get('admin_data');                          //中间件产生的管理员数据参数
        if($admin_data['id'] != 1 && $admin_data['organization_id'] != 0){      //如果是超级管理员并且已经切换身份成功则跳转
            return redirect('branch');
        }
        $organization_name  = $request->organization_name;
        $where = ['type'=>'5'];//type=5分店组织
        $organization = Organization::getBranchAndWarzone($organization_name,$where,20,'id','ASC'); //查询分店
        foreach ($organization as $key=>$val){
            $catering = Organization::getOneCatering(['id'=>$val->parent_id]);
            $val->cateringname = $catering->organization_name;
        }
        return  view('Branch/Account/branch_list',['organization'=>$organization,'organization_name'=>$organization_name]);
    }

    //选择店铺
    public function branch_select(Request $request)
    {
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $organization_id = $request->organization_id;           //获取当前选择店铺的组织
        $parent_id = $request->parent_id;                       //获取当前店铺的上级
        //如果是超级管理员且商户组织ID有值并且当前管理员的组织ID为空
        if ($admin_data['is_super'] == '1' && !empty($organization_id) && $admin_data['organization_id'] == 0){
            $this->superadmin_login($organization_id);      //超级管理员选择身份登录
            return response()->json(['data' => '成功选择店铺，即将前往该店铺！', 'status' => '1']);
        }else{
            return response()->json(['data' => '操作失败，请稍后再试！', 'status' => '1']);
        }

    }

    //超级管理员退出当前店铺（切换店铺）
    public function branch_switch(Request $request){
        $admin_data = $request->get('admin_data');          //中间件产生的管理员数据参数
        $admin_data['organization_id'] = 0;
        ZeroneRedis::create_branch_account_cache(1,$admin_data);//清空所选组织
        return redirect('branch');
    }

    //超级管理员以分店平台普通管理员登录处理
    public function superadmin_login($organization_id)
    {
        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','7']]);//根据账号查询
        //Admin登录商户平台要生成的信息
        //重新生成缓存的登录信息
        $admin_data = [
            'id'=>$account_info->id,                            //用户ID
            'organization_id'=>$account_info->organization_id,  //组织ID
            'parent_id'=>$account_info->parent_id,              //上级ID
            'parent_tree'=>$account_info->parent_tree,          //上级树
            'deepth'=>$account_info->deepth,                    //账号在组织中的深度
            'account'=>$account_info->account,                  //用户账号
            'password'=>$account_info->password,                //用户密码
            'safe_password'=>$account_info->safe_password,      //安全密码
            'is_super'=>1,                                      //这里设置成1超级管理员，便于切换各个商户组织
            'status'=>$account_info->status,                    //用户状态
            'mobile'=>$account_info->mobile,                    //绑定手机号
        ];
        Session::put('branch_account_id', encrypt(1));         //存储登录session_id为当前用户ID
        //构造用户缓存数据
        if (!empty($account_info->account_info->realname)) {
            $admin_data['realname'] = $account_info->account_info->realname;
        } else {
            $admin_data['realname'] = '未设置';
        }
        if (!empty($account_info->account_roles) && $account_info->account_roles->count() != 0) {
            foreach ($account_info->account_roles as $key => $val) {
                $account_info->role = $val;
            }
            $admin_data['role_name'] = $account_info->role->role_name;
        } else {
            $admin_data['role_name'] = '角色未设置';
        }
        ZeroneRedis::create_branch_account_cache(1, $admin_data);//生成账号数据的Redis缓存
        ZeroneRedis::create_branch_menu_cache(1);//生成对应账号的商户系统菜单
    }
}

?>