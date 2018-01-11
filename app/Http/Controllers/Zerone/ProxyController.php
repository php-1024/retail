<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ProxyApply;
use App\Models\Warzone;
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
            echo $request->input('organization_name');exit;
//        $proxy_name = $request->input('organization_name');//服务商名称
//
//        $where = [['proxy_name',$proxy_name]];
//
//        $name = ProxyApply::checkRowExists($where);
//
//        if(!empty($name)){
//            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
//        }
//        $proxy_owner_mobile = $request->input('proxy_owner_mobile');//手机号码
//
//        $data = [['proxy_owner_mobile',$proxy_owner_mobile]];
//
//        $mobile = ProxyApply::checkRowExists($data);
//
//        if(!empty($mobile)){
//            return response()->json(['data' => '手机号已存在', 'status' => '0']);
//        }
        $listdata[] = ['organization_name'=>$request->input('organization_name')];
        $listdata[] = ['parent_id'=>0];
        $listdata[] = ['parent_tree'=>0];
        $listdata[] = ['program_id'=>0];
        $listdata[] = ['type'=>2];
        $listdata[] = ['status'=>1];
        $orgid = Organization::addProgram($listdata);
        if(!empty($orgid)){
            return response()->json(['data' => '注册成功', 'status' => '1']);
        }else{
            return response()->json(['data' => '注册失败', 'status' => '0']);
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