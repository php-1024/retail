<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Proxy_apply;
use App\Models\Warzone;
use Illuminate\Http\Request;
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
        $where = [['proxy_name',$request->input('proxy_name')]];

        $name = Proxy_apply::getPluck($where,'proxy_name');

        if(!empty($name)){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }
        $aa = $request->input('proxy_name');
        dump($aa);
        $data = [['proxy_owner_mobile','123456']];
        echo "123";
        exit;
        $mobile = Proxy_apply::getPluck($data,'proxy_owner_mobile');

        if(!empty($mobile)){
            return response()->json(['data' => '手机号已注册', 'status' => '0']);
        }

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