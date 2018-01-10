<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class ProxyController extends Controller{
    //添加服务商
    public function proxy_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数

        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/Proxy/proxy_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }

    //服务商审核列表
    public function proxy_examinelist(Request $request){
        echo "服务商审核列表";
    }
    //服务商审核列表
    public function proxy_examine(Request $request){
        echo "服务商审核数据提交";
    }

    //服务商列表
    public function proxy_list(Request $request){
        echo "服务商列表";
    }

    //编辑下级人员
    public function subordinate_edit(Request $request){
        echo "这里是编辑下级人员";
    }

    //编辑下级人员数据提交
    public function subordinate_edit_check(Request $request){
        echo "这里是编辑下级人员数据提交";
    }

    //冻结下级人员
    public function subordinate_lock(Request $request){
        echo "这里是冻结下级人员";
    }

    //删除下级人员
    public function subordinate_delete(Request $request){
        echo "这里是删除下级人员";
    }

    //下级人员结构
    public function subordinate_structure(Request $request){

    }
}
?>