<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\LoginLog;
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

        $admin_data = LoginLog::where('id','1');
        dd($admin_data);
        $organization_name = $request->input('organization_name');//服务商名称

        $where = [['organization_name',$organization_name]];

        $name = Organization::checkRowExists($where);

        if($name == 'true'){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }
        $parent_id = '1';//上级ID是当前用户ID
        $parent_tree = '0'.','.'1';//树是上级的树拼接上级的ID；
        $deepth = 1;  //用户在该组织里的深度

        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$request->input('organization_name'),'parent_id'=>0,'parent_tree'=>0,'program_id'=>0,'type'=>2,'status'=>1];
            $organization_id = Organization::addProgram($listdata); //返回值为商户的id


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