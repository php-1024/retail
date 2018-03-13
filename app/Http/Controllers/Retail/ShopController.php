<?php
namespace App\Http\Controllers\Retail;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
use App\Models\OperationLog;
use App\Models\Organization;
use Illuminate\Http\Request;
use Session;
class ShopController extends Controller{
    //添加服务商
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];//服务商id
        if($admin_data['is_super'] == 1 ){
            $organization_name  = $request->organization_name;
            $where = ['type'=>'9'];
//            $listOrg = Organization::where([['program_id','4']])->get();
            $listOrg = Organization::getCateringAndAccount($organization_name,$where,20,'id','ASC'); //查询分店
            return view('Retail/Shop/select_shop',['listOrg'=>$listOrg]);
        }else{
            $where = [['organization_id',$organization_id]];
            $account_id = Account::getPluck([['organization_id',$organization_id],['parent_id',1]],'id')->first();//获取负责人id
            if($account_id != $admin_data['id']) {//如果不是服务商负责人 只允许看自己的登入记录
                $where[] = ['account_id',$admin_data['id']];
            }
            $login_log_list = LoginLog::getList($where,5,'id');//登录记录
            $operation_log_list = OperationLog::getList($where,5,'id');//操作记录
            $acc_num = Account::where([['organization_id',$organization_id]])->count();//查询服务商人数
            $org_num = Organization::where([['parent_id',$organization_id]])->count();//查询服务商附属商务个数
            return view('Retail/Shop/index',['login_log_list'=>$login_log_list,'operation_log_list'=>$operation_log_list,'acc_num'=>$acc_num,'org_num'=>$org_num,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }
    }
    //超级管理员选择服务商
    public function select_shop(Request $request){
        $admin_this = $request->get('admin_data');              //中间件产生的管理员数据参数
//        $organization_id = $request->input('organization_id');  //中间件产生的管理员数据参数
        $account_id = $request->input('account_id');            //用户ID
//        $account_info = Account::getOneAccount([['organization_id',$organization_id],['parent_id','1']]);//根据账号查询
        $account_info = Account::getOneAccount([['id',$account_id]]);//根据账号查询
        if(!empty($account_info)){
            //重新生成缓存的登录信息
            $admin_data = [
                'id'=>$account_info->id,    //用户ID
                'account'=>$account_info->account,//用户账号
                'organization_id'=>$account_info->organization_id,//组织ID
                'is_super'=>'2',//是否超级管理员
                'parent_id'=>$account_info->parent_id,//上级ID
                'parent_tree'=>$account_info->parent_tree,//上级树
                'deepth'=>$account_info->deepth,//账号在组织中的深度
                'mobile'=>$account_info->mobile,//绑定手机号
                'safe_password'=>$admin_this['safe_password'],//安全密码-超级管理员
                'account_status'=>$account_info->status,//用户状态
            ];
            Session::put('catering_account_id',encrypt(1));//存储登录session_id为当前用户ID
            //构造用户缓存数据
            if(!empty( $account_info->account_info->realname)) {
                $admin_data['realname'] = $account_info->account_info->realname;
            }else{
                $admin_data['realname'] = '未设置';
            }
            if(!empty($account_info->account_roles) && $account_info->account_roles->count() != 0) {
                foreach ($account_info->account_roles as $key => $val) {
                    $account_info->role = $val;
                }
                $admin_data['role_name'] = $account_info->role->role_name;
            }else{
                $admin_data['role_name'] = '角色未设置';
            }
            \ZeroneRedis::create_catering_account_cache(1,$admin_data);//生成账号数据的Redis缓存
            \ZeroneRedis::create_catering_menu_cache(1);//生成对应账号的系统菜单
            return response()->json(['data' => '操作成功', 'status' => '1']);

        }else{
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
    }
    //超级管理员选择店铺
    public function switch_status(Request $request){
        return redirect('retail');
    }
    //退出登录
    public function quit(Request $request){
        Session::put('retail_account_id','');
        return redirect('retail/login');
    }
}
?>