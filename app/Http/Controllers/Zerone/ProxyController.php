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

        $organization_name = $request->input('organization_name');//服务商名称

        $where = ['organization_name',$organization_name];

        $name = Organization::checkRowExists($where,'id');

        if(!empty($name)){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }
//        $proxy_owner_mobile = $request->input('proxy_owner_mobile');//手机号码
//
//        $data = [['proxy_owner_mobile',$proxy_owner_mobile]];
//
//        $mobile = ProxyApply::checkRowExists($data);
//
//        if(!empty($mobile)){
//            return response()->json(['data' => '手机号已存在', 'status' => '0']);
//        }
        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$request->input('organization_name'),'parent_id'=>0,'parent_tree'=>0,'program_id'=>0,'type'=>2,'status'=>1];
            Organization::addProgram($listdata);
            //OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'删除了权限角色，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
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