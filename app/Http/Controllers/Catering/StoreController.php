<?php
namespace App\Http\Controllers\Catering;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Package;
use Illuminate\Http\Request;
use Session;
class StoreController extends Controller{
    //创建总分店
    public function branch_create(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $admin_data['organization_id'];
        $onebranch = Organization::checkRowExists([['parent_id',$organization_id],['type',5]]); //查询有没有总店，如果有，接下来创建的都是分店
        $package_program = Package::getList(['id'=>1],0,'id','DESC');   //查询当前所选餐包含的程序 1为餐饮系统
        return view('Catering/Store/branch_create',['onebranch'=>$onebranch,'onebranch'=>$onebranch,'package_program'=>$package_program,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
        }

    //分店店管理
    public function branch_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Catering/Store/branch_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

}
?>