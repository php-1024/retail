<?php
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Models\Module;
use App\Models\ModuleNode;
use App\Libraries\ZeroneLog\ProgramLog;

class ModuleController extends Controller{
    //添加功能模块
    public function module_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $node_list = Node::where('is_delete','0')->get();
        return view('Program/Module/module_add',['node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //提交添加功能模块数据
    public function module_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_name  = $request->input('module_name');//获取功能模块名称
        $nodes = $request->input('nodes');//获取选择的节点

        $module = new Module();
        $info = $module->where('module_name',$module_name)->where('is_delete','0')->pluck('id')->toArray();
        if(!empty($info)){
            return response()->json(['data' => '模块名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $module_node = new ModuleNode();//重新实例化模型，避免重复
                $module = new Module();
                $module->module_name=$module_name;
                $module->save();
                $module_id = $module->id;
                foreach($nodes as $key=>$val){
                    $module_node_data[] = ['module_id'=>$module_id,'node_id'=>$val,'created_at'=>time(),'updated_at'=>time()];
                }
                $module_node->insert($module_node_data);

                ProgramLog::setOperationLog($admin_data['admin_id'],$route_name,'添加了功能模块'.$module_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加功能模块失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加功能模块成功', 'status' => '1']);
        }
    }
    //功能模块列表
    public function module_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $module = new Module();
        $module_name = $request->input('module_name');
        $search_data = ['module_name'=>$module_name];
        if(!empty($module_name)){
            $module = $module->where('module_name','like','%'.$module_name.'%');
        }
        $list = $module->where('is_delete','0')->paginate(15);
        foreach($list as $key=>$val){
            $node[$val->id] = ModuleNode::where('module_id',$val->id)->where('module_node.is_delete','0')->join('node',function($json){
                $json->on('node.id','=','module_node.node_id');
            })->select('module_node.*','node.node_name')->get();
        }
        return view('Program/Module/module_list',['list'=>$list,'node'=>$node,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //编辑功能模块列表
    public function module_edit(Request $request){
        $module_node = new ModuleNode();
        $id = $request->input('id');
        $info = Module::find($id);
        $module_node = new ModuleNode();
        $module_node = $module_node->join('node',function($json){
            $json->on('node.id','=','module_node.node_id');
        });
        $node_list_selected = $module_node->where('module_id',$id)->where('module_node.is_delete','0')->select('module_node.*','node.node_name')->get()->toArray();
        $selected_id[] = '';
        foreach($node_list_selected as $key=>$val){
            $selected_id[] = $val['node_id'];
        }
        $node = new Node();
        $node_list_unselected = $node->whereNotIn('id',$selected_id)->where('is_delete','0')->get();

        return view('Program/Module/module_edit',['info'=>$info,'node_list_selected'=>$node_list_selected,'node_list_unselected'=>$node_list_unselected]);
    }
    //编辑功能模块列表
    public function module_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $module_name  = $request->input('module_name');//获取功能模块名称
        $nodes = $request->input('nodes');//获取选择的节点

        $module = new Module();
        $info = $module->where('module_name',$module_name)->where('id','!=',$id)->where('is_delete','0')->pluck('id')->toArray();
        if(!empty($info)){
            return response()->json(['data' => '模块名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $module_node = new ModuleNode();//重新实例化模型，避免重复
                $module = new Module();
                $module->where('id',$id)->update(['module_name'=>$module_name]);

                foreach($nodes as $key=>$val){
                    $vo = $module_node->where('node_id',$val)->where('is_delete','0')->first();//查询是否存在数据
                    if($vo->isEmpty()){
                        $module_node_data[] = ['module_id'=>$id,'node_id'=>$val,'created_at'=>time(),'updated_at'=>time()];//不存在则添加数据
                    }else{
                        continue;//存在则跳过;
                    }
                    $vo = '';
                }

                //首先删除这次删除的数据的数据
                 $module_node->where('module_id',$id)->whereNotIn('node_id',$nodes)->delete();
                //如果插入的数据不为空,则插入
                if(!empty($module_node_data)){
                    $module_node->insert($module_node_data);
                }
                ProgramLog::setOperationLog($admin_data['admin_id'],$route_name,'编辑了功能模块'.$module_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                dump($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑功能模块失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑功能模块成功', 'status' => '1']);
        }
    }
}
?>