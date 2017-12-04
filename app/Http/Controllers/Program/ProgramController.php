<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use App\Models\Module;
use App\Models\ModuleNode;
use App\Models\OperationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\ProgramAdmin;
use App\Models\ProgramOperationLog;
use App\Models\ProgramLoginLog;
use App\Libraries\ZeroneLog\ProgramLog;
use APP\Models\Program;


class ProgramController extends Controller{
    public function program_add(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module = new Module(); //实例化功能模块模型
        $module_list = $module->where('is_delete', '0')->get()->toArray();
        $node_list = [];

        if (!empty($module_list)) {
            foreach ($module_list as $key => $val) {
                $module_node = new ModuleNode();
                $node_list[$val['id']] = $module_node->join('node',function($join){
                    $join->on('node.id','=','module_node.node_id');
                })->where('module_id', $val['id'])->where('module_node.is_delete', '0')->select('node.node_name,module_node.*')->get()->toArray();
            }
        }
        dump($module_list);
        dump($node_list);
        return view('Program/Program/program_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }
}
?>