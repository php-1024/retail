<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ProgramModuleNode;
use Illuminate\Http\Request;
use Session;

class PersonalController extends Controller{
    //个人中心——个人资料
    public function display(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account_node_list = ProgramModuleNode::getAccountModuleNodes(1,$admin_data['id']);//获取当前用户具有权限的节点
        dump($account_node_list);
        return view('Zerone/Personal/display',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name,'account_node_list'=>$account_node_list]);
    }
    //个人中心——登录密码修改
    public function password_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Personal/password_edit',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }

    //个人中心——登录密码修改
    public function password_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $account = Account::getOne([['id',$admin_data['id']]]);
        $password = $request->input('password');
        $new_password = $request->input('new_password');
        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $new_encrypted = md5($new_password);//加密新密码第一重
        $new_encryptPwd = md5("lingyikeji".$new_encrypted.$key);//加密新码第二重
        if ($account['password'] == $encryptPwd){
            Account::editAccount([['id',$admin_data['id']]],['password' => $new_encryptPwd]);
            return response()->json(['data' => '密码修改成功！', 'status' => '1']);
        }else{
            return response()->json(['data' => '原密码不正确！', 'status' => '1']);
        }
    }

    //个人中心——安全密码设置
    public function safe_password(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $account = Account::getOne([['id',$admin_data['id']]]);
        return view('Zerone/Personal/safe_password',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //个人中心——安全密码修改(设置)
    public function safe_password_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $safe_password = $request->input('safe_password');           //安全密码
        $new_safe_password = $request->input('new_safe_password');   //新安全密码
        $key = config("app.zerone_safe_encrypt_key");//获取加密盐
        $encrypted = md5($safe_password);//加密安全密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密安全密码第二重
        $new_encrypted = md5($new_safe_password);//加密新安全密码第一重
        $new_encryptPwd = md5("lingyikeji".$new_encrypted.$key);//加密新安全密码第二重
        if ($admin_data['safe_password'] == $encryptPwd){
            Account::editAccount([['id',$admin_data['id']]],['safe_password' => $new_encryptPwd]);
            Session::put('zerone_account_id','');
            return response()->json(['data' => '安全密码修改成功，请退出后重新登录！', 'status' => '1']);
        }else{
            return response()->json(['data' => '原密码不正确！', 'status' => '1']);
        }
    }
    //个人中心——我的操作日志
    public function operation_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Personal/operation_log',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
    //个人中心——我的登录日志
    public function login_log(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/Personal/login_log',['admin_data'=>$admin_data,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'route_name'=>$route_name]);
    }
}
?>