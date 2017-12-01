<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramAdmin;
use App\Libraries\ZeroneLog\ProgramLog;

class SystemController extends Controller{
    //后台首页
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/System/dashboard',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //新增账号
    public function account_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/System/account_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //提交新增账号数据
    public function account_add_check(Request $request){
        $account = $request->input('account');//获取账号
        $password = $request->input('password');//获取密码
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $encrypt_key = config("app.program_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$encrypt_key);//加密密码第二重

        $admin = new ProgramAdmin();//实例化模型
        $info = $admin->where('account',$account)->pluck('id')->toArray();//查询是否有相同的账号存在

        if(!empty($info)){//如果存在报错
            return response()->json(['data' => '该账号已存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $admin = new ProgramAdmin();//重新实例化模型，避免重复
                $admin->account = $account;
                $admin->password = $encryptPwd;
                $admin->save();//添加账号
                ProgramLog::setOperationLog($admin_data['admin_id'],$route_name,'新增了管理员账号'.$account);
                DB::commit();
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加账号失败，请检查', 'status' => '0']);
            }
        }
        return response()->json(['data' => '添加账号成功', 'status' => '1']);
    }

    //账号列表
    public function account_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $account = $request->input('account');//通过登录页账号查询
        dump($account);
        $search_data = ['account'=>$account];
        $admin = new ProgramAdmin();//实例化模型
        $list = $admin->paginate(1);
        return view('Program/System/account_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'system']);
    }

    //退出登录
    public function quit(Request $request){
        Session::put('zerone_program_account_id','');
        return redirect('program/login');
    }
}
?>