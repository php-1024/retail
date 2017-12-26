<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Tooling;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\ToolingOperationLog;
use App\Models\Program;
use App\Models\ProgramModuleNode;


class ProgramController extends Controller{
    public function program_add(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $plist = Program::getList([[ 'complete_id','0' ]],0,'id');
        return view('Tooling/Program/program_add',['plist'=>$plist,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }

    //Ajax获取上级节点
    public function program_parents_node(Request $request){
        $pid = $request->input('pid');
        $editid = $request->input('editid');
        if(empty($pid) || $pid=='0'){//没有主程序时
            $module_list = Module::getListSimple([],0,'id');
        }else{//有主程序时
            $module_list = Module::getListProgram($pid,[],0,'id');
        }
        $selected_node = [];
        $selected_module = [];
        if(!empty($editid)) {
            $list = ProgramModuleNode::getList([[ 'program_id',$editid ]],0,'id');
            foreach ($list as $key => $val) {
                if(!in_array($val->module_id,$selected_module)){
                    $selected_module[] = $val->module_id;
                }
                $selected_node[] = $val->module_id . '_' . $val->node_id;
            }
        }
        return view('Tooling/Program/program_parents_node',['pid'=>$pid,'module_list'=>$module_list,'selected_node'=>$selected_node,'selected_module'=>$selected_module]);
    }
    //检测添加数据
    public function program_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $program_name = $request->input('program_name');//程序名称
        $complete_id = $request->input('complete_id');//上级程序
        $is_classic = empty($request->input('is_classic'))?'0':'1';//是否通用版本
        $is_asset = empty($request->input('is_asset'))?'0':'1';//是否资产程序
        $is_coupled = empty($request->input('is_coupled'))?'0':'1';//是否夫妻程序
        $module_node_ids = $request->input('module_node_ids');//节点数组

        if(Program::checkRowExists([[ 'program_name',$program_name ]])){
            return response()->json(['data' => '程序名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $program_id = Program::addProgram(['program_name'=>$program_name,'complete_id'=>$complete_id,'is_classic'=>$is_classic,'is_asset'=>$is_asset,'is_coupled'=>$is_coupled]);

                //循环节点生成多条数据
                foreach($module_node_ids as $key=>$val){
                    $arr = explode('_',$val);
                    $module_id = $arr[0];//功能模块ID
                    $node_id = $arr[1];//功能节点ID
                    ProgramModuleNode::addProgramModuleNode(['program_id'=>$program_id,'module_id'=>$module_id,'node_id'=>$node_id]);
                }
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'添加了程序'.$program_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加程序失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加程序成功', 'status' => '1']);
        }
    }
    //程序数据列表
    public function program_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $program_name = $request->input('program_name');
        $search_data['program_name'] = $program_name;
        $list = Program::getPaginage([[ 'program_name','like','%'.$program_name.'%' ]],15,'id');
        $module_list = [];//功能模块列表
        $node_list = [];//功能节点列表
        $pname = [];//上级程序名称列表
        foreach($list as $key=>$val){

            $program_id = $val->id;
            $module_list[$val->id] =Module::where('id',1)->where('is_delete',0)->get();
            $tt =Module::where('id',1)->where('is_delete',0)->get();
            dump($tt);

            $ppname = Program::where('id',$val->pid)->pluck('program_name')->toArray();//获取用户名称
            if(empty($ppname)){
                $pname[$val->id] = '独立主程序';
            }else{
                $pname[$val->id] = $ppname[0];
            }
        }

        return view('Tooling/Program/program_list',['list'=>$list,'search_data'=>$search_data,'module_list'=>$module_list,'pname'=>$pname,'node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }
    //获取编辑程序
    public function program_edit(Request $request){
        $id = $request->input('id');
        $info = Program::find($id);
        $plist = Program::getList([[ 'complete_id','0' ]],0,'id');

        return view('Tooling/Program/program_edit',['info'=>$info,'plist'=>$plist]);
    }
    //提交编辑程序数据
    public function program_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $program_name = $request->input('program_name');//程序名称
        $pid = $request->input('pid');//上级程序
        $is_classic = empty($request->input('is_classic'))?'0':'1';//是否通用版本
        $module_node_ids = $request->input('module_node_ids');//节点数组
        $info = Program::where('program_name',$program_name)->where('id','!=',$id)->where('is_delete','0')->pluck('id')->toArray();

        if(!empty($info)){
            return response()->json(['data' => '程序名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $program = new Program();//实例化程序模型
                $program_module_node = new ProgramModuleNode();
                $program->where('id',$id)->update(['program_name'=>$program_name,'pid'=>$pid,'is_classic'=>$is_classic,'updated_at'=>time()]);

                $node_ids = [];
                //循环节点生成多条数据
                foreach($module_node_ids as $key=>$val){
                    $arr = explode('_',$val);
                    $module_id = $arr[0];//功能模块ID
                    $node_id = $arr[1];//功能节点ID
                    $node_ids[] = $node_id;//获取这次的ID
                    $vo = $program_module_node->where('program_id',$id)->where('module_id',$module_id)->where('node_id',$node_id)->where('is_delete','0')->first();//查询是否存在数据
                    if(is_null($vo)) {//不存在生成插入数据
                        $program_module_node_data[] = ['program_id' => $id, 'module_id' => $module_id, 'node_id' => $node_id, 'created_at' => time(), 'updated_at' => time()];
                    }else{
                        continue;
                    }
                    $vo='';
                }
                //删除数据库中不在这次插入的数据
                $program_module_node->where('program_id',$id)->whereNotIn('node_id',$node_ids)->delete();

                $program_module_node = new ProgramModuleNode();//实例化程序模块关系表模型
                //如果插入的数据不为空,则插入
                if(!empty($program_module_node_data)){
                    $program_module_node->insert($program_module_node_data);
                }

                ToolingLog::setOperationLog($admin_data['admin_id'],$route_name,'编辑了程序'.$program_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑程序失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑程序成功', 'status' => '1']);
        }
    }
}
?>