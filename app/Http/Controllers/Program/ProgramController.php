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
        $plist = Program::where('pid','0')->where('is_delete','0')->get();

        return view('Program/Program/program_add',['plist'=>$plist,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }

    //Ajax获取上级节点
    public function program_parents_node(Request $request){
        $pid = $request->input('pid');

        if(empty($pid) || $pid=='0'){
            $module = new Module(); //实例化功能模块模型
            $module_list = $module->where('is_delete', '0')->get()->toArray();
            $node_list = [];

            if (!empty($module_list)) {
                foreach ($module_list as $key => $val) {
                    $node_list[$val['id']] = ModuleNode::where('module_id',$val['id'])->where('module_node.is_delete','0')->join('node',function($json){
                        $json->on('node.id','=','module_node.node_id');
                    })->select('module_node.*','node.node_name')->get()->toArray();
                }
            }
        }else{
            $module_list = ProgramModuleNode::where('program_id',$pid)->where('program_module_node.is_delete','0')->join('module',function($join){
                $join->on('program_module_node.module_id','=','module.id');
            })->distinct()->select('program_module_node.module_id as id','module.module_name')->get()->toArray();

            $node_list = [];
            if (!empty($module_list)) {
                foreach ($module_list as $key => $val) {
                    $node_list[$val['id']] = ProgramModuleNode::where('module_id',$val['id'])->where('program_id',$pid)->where('program_module_node.is_delete','0')->join('node',function($json){
                        $json->on('node.id','=','program_module_node.node_id');
                    })->select('program_module_node.*','node.node_name')->get()->toArray();
                }
            }
        }

        return view('Program/Program/program_parents_node',['module_list'=>$module_list,'node_list'=>$node_list]);
    }
    //检测添加数据
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

                //循环节点生成多条数据
                foreach($module_node_ids as $key=>$val){
                    $arr = explode('_',$val);
                    $module_id = $arr[0];//功能模块ID
                    $node_id = $arr[1];//功能节点ID
                    $program_module_node_data[] = ['program_id'=>$program_id,'module_id'=>$module_id,'node_id'=>$node_id,'created_at'=>time(),'updated_at'=>time()];
                }

                $program_module_node = new ProgramModuleNode();//实例化程序模块关系表模型
                //如果插入的数据不为空,则插入
                if(!empty($program_module_node_data)){
                    $program_module_node->insert($program_module_node_data);
                }

                ProgramLog::setOperationLog($admin_data['admin_id'],$route_name,'添加了程序'.$program_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加了程序失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加了程序成功', 'status' => '1']);
        }
    }
    //程序数据列表
    public function program_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $program = new Program();

        $list = $program->where('is_delete','0')->paginate(15);
        $module_list = [];
        $node_list = [];
        foreach($list as $key=>$val){
            $module_list[$val->id] = ProgramModuleNode::where('program_id',$val->id)->where('program_module_node.is_delete','0')->join('module',function($join){
                $join->on('program_module_node.module_id','=','module.id');
            })->distinct()->select('program_module_node.module_id as id','module.module_name')->get()->toArray();

            foreach ( $module_list[$val->id] as $kk => $vv) {
                $node_list[$vv['id']] = ProgramModuleNode::where('module_id',$vv['id'])->where('program_id',$val->id)->where('program_module_node.is_delete','0')->join('node',function($json){
                    $json->on('node.id','=','program_module_node.node_id');
                })->select('program_module_node.*','node.node_name')->get()->toArray();
            }
        }

        return view('Program/Program/program_list',['list'=>$list,'module_list'=>$module_list,'node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }
}
?>