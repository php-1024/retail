<?php
/**
 *新版本登录界面
 *
 **/
namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Session;

class StoreController extends Controller{
    //店铺管理创建店铺
    public function store_add(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $program = Program::getList(['id'=>3],0,'id','DESC');//查询所有商户系统套餐程序
        dump($program);
        return view('Company/Store/store_add',['program'=>$program,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺管理立即开店
    public function store_add_second(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        $package_id = $request->package_id;             //套餐id
        $program = Program::getList(['complete_id'=>'3'],0,'id','DESC');
        $package_program = Package::getList(['id'=>$package_id],0,'id','DESC');   //查询当前所选餐包含的程序
        dump($package_program);
        return view('Company/Store/store_add_second',['program'=>$program,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺管理
    public function store_list(Request $request)
    {
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();                 //获取当前的页面路由
        return view('Company/Store/store_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>