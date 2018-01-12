<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\LoginLog;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ProxyApply;
use App\Models\Warzone;
use Illuminate\Support\Facades\DB;
use Session;
class ProxyController extends Controller{
    //添加服务商
    public function proxy_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $warzone_list = Warzone::all();

        return view('Zerone/Proxy/proxy_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'warzone_list'=>$warzone_list]);
    }
    //提交服务商数据
    public function proxy_add_check(Request $request){

        $admin_data = LoginLog::where('id',1)->first();//查找超级管理员的数据

        $organization_name = $request->input('organization_name');//服务商名称

        $where = [['organization_name',$organization_name]];

        $name = Organization::checkRowExists($where);

        if($name == 'true'){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }
        $parent_id = $admin_data['id'];//上级ID是当前用户ID
        $parent_tree = $admin_data['parent_tree'].','.$parent_id;//树是上级的树拼接上级的ID；
        $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度
        $mobile = $request->input('mobile');//手机号码
        $password = $request->input('password');//用户密码

        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$organization_name,'parent_id'=>0,'parent_tree'=>0,'program_id'=>0,'type'=>2,'status'=>1];
            $organization_id = Organization::addProgram($listdata); //返回值为商户的id
            $account  = 'P'.$organization_id.'_'.$mobile;//用户账号
            $accdata = ['parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'deepth'=>$deepth,'mobile'=>$mobile,'password'=>$encryptPwd,'organization_id'=>$organization_id,'account'=>$account];
            $account_id = Account::addAccount($accdata);//添加账号返回id
            $realname = $request->input('realname');//负责人姓名
            $idcard = $request->input('idcard');//负责人身份证号
            $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
            AccountInfo::addAccountInfo($acinfodata);
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '注册失败', 'status' => '0']);
        }
        return response()->json(['data' => '注册成功', 'status' => '1']);

    }

    //服务商审核列表
    public function proxy_examinelist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Proxy/proxy_examinelist',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商审核列表
    public function proxy_examine(Request $request){
        echo "服务商审核数据提交";
    }

    //服务商列表
    public function proxy_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Proxy/proxy_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

}
?>