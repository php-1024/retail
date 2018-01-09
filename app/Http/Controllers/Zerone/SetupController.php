<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Models\Module;
Use App\Models\OrganizationRole;
Use App\Models\RoleNode;
Use App\Models\OperationLog;

use Session;

class SetupController extends Controller{
    //参数设置展示
    public function setup_show(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $role_name = $request->input('role_name');
        $search_data = ['role_name'=>$role_name];

        return view('Zerone/Setup/setup_show',['search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //参数设置编辑
    public function setup_edit(Request $request){
        echo "这里是参数设置编辑页面";
    }
}