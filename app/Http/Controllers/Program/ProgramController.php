<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use App\Models\Module;
use App\Models\ModuleNode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Libraries\ZeroneLog\ProgramLog;
use App\Models\Program;
use App\Models\ProgramModuleNode;


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
                $node_list[$val['id']] = ModuleNode::where('module_id',$val['id'])->where('module_node.is_delete','0')->join('node',function($json){
                    $json->on('node.id','=','module_node.node_id');
                })->select('module_node.*','node.node_name')->get()->toArray();
            }
        }
        return view('Program/Program/program_add',['module_list'=>$module_list,'node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }

    public function program_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $program_name = $request->input('program_name');//程序名称
        $pid = $request->input('pid');//上级程序
        $is_universal = empty($request->input('is_universal'))?'0':'1';//是否通用版本
        $module_node_ids = $request->input('module_node_ids');//节点数组

        $info = Program::where('program_name',$program_name)->where('is_delete','0')->pluck('id')->toArray();
        if(!empty($info)){
            return response()->json(['data' => '程序名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $program = new Program();//实例化程序模型
                $program->program_name = $program_name;//程序名称
                $program->pid = $pid;//上级程序
                $program->is_universal = $is_universal;//是否通用版本
                $program->save();
                $program_id = $program->id;

                $arr = explode('-',$module_node_ids);
                $module_id = $arr[0];//功能模块ID
                $node_id = $arr[1];//功能节点ID

                $program_module_node = new ProgramModuleNode();//实例化程序模块关系表模型
                $program_module_node->program_id = $program_id;//程序ID
                $program_module_node->module_id = $module_id;//功能模块ID
                $program_module_node->node_id = $node_id;//功能节点ID
                $program_module_node->save();

                ProgramLog::setOperationLog($admin_data['admin_id'],$route_name,'添加了程序'.$program_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加了程序失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加了程序成功', 'status' => '1']);
        }
    }
}
?>