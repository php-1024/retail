<?php
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Libraries\ZeroneLog\ProgramLog;

class ModuleController extends Controller{
    //修改个人密码
    public function add_moudle(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/Moudle/add_moudle',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //提交修改个人密码数据
    public function check_add_moudle(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由
    }
}
?>