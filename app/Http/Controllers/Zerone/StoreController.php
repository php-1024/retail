<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Assets;
use App\Models\Module;
use App\Models\Organization;
use App\Models\Package;
use App\Models\Program;
use Illuminate\Http\Request;
use Session;
class StoreController extends Controller{
    //店铺列表
    public function store_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_list',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //店铺添加
    public function store_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = Program::getPaginage([['complete_id','3']],15,'id');
        $module_list = [];//功能模块列表
        foreach($list as $key=>$val){
            $program_id = $val->id;
            $module_list[$val->id] =Module::getListProgram($program_id,[],0,'id');
        }
        return view('Zerone/Store/store_add',['list'=>$list,'module_list'=>$module_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺添加
    public function store_insert(Request $request){
        $program_id = $request->input('id');//程序id
        $program_name = Program::getPluck([['id',$program_id]],'program_name')->first();//程序名字
        $organization_name = Organization::where([['type','3'],['status','1']])->Orwhere([['type','1']])->pluck('organization_name','id');//上级组织名字，id
        return view('Zerone/Store/store_insert',['program_id'=>$program_id,'program_name'=>$program_name,'organization_name'=>$organization_name]);
    }

    //店铺人员架构
    public function store_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_structure',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺分店管理
    public function store_branchlist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_branchlist',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺设置参数
    public function store_config(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Store/store_config',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


}