<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramAdmin;
use App\Models\ProgramOperationLog;
use App\Models\ProgramLoginLog;
use App\Libraries\ZeroneLog\ProgramLog;

class ProgramController extends Controller{
    public function program_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        //$node_list = Node::where('is_delete','0')->get();
        return view('Program/Program/program_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }
}
?>