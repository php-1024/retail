<?php
namespace App\Http\Controllers\Tooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Models\Module;
use App\Models\ModuleNode;
use App\Models\ToolingOperationLog;

class ModuleController extends Controller{
    //添加功能模块
    public function module_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $node_list = Node::getList([],0,'id');
        return view('Tooling/Module/module_add',['node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //提交添加功能模块数据
    public function module_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_name  = $request->input('module_name');//获取功能模块名称
        $module_show_name  = $request->input('module_show_name');//获取功能模块展示名称
        $nodes = $request->input('nodes');//获取选择的节点

        if(Module::checkRowExists([[ 'module_name',$module_name ]])){
            return response()->json(['data' => '模块名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $module_id = Module::addModule(['module_name'=>$module_name,'module_show_name'=>$module_show_name]);
                foreach($nodes as $key=>$val){
                    ModuleNode::addModuleNode(['module_id'=>$module_id,'node_id'=>$val]);
                }
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'添加了功能模块'.$module_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
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
        $module_name = $request->input('module_name');
        $search_data = ['module_name'=>$module_name];
        $list = Module::getPaginage([[ 'module_name','like','%'.$module_name.'%' ]],15,'id');
        return view('Tooling/Module/module_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //编辑功能模块列表
    public function module_edit(Request $request){
        $id = $request->input('id');
        $info = Module::find($id);
        $node_list_selected = Node::node_selected($id);
        $node_list_unselected = Node::node_unselected($id);

        return view('Tooling/Module/module_edit',['info'=>$info,'node_list_selected'=>$node_list_selected,'node_list_unselected'=>$node_list_unselected]);
    }
    //编辑功能模块列表
    public function module_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $module_name  = $request->input('module_name');//获取功能模块名称
        $module_show_name  = $request->input('module_show_name');//获取功能模块名称
        $nodes = $request->input('nodes');//获取选择的节点

        if(Module::checkRowExists([[ 'module_name',$module_name ],[ 'id','!=',$id ]])){
            return response()->json(['data' => '模块名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                Module::editModule([[ 'id',$id ]],['module_name'=>$module_name,'module_show_name'=>$module_show_name]);
                foreach($nodes as $key=>$val){
                    $vo = ModuleNode::getOne([['module_id',$id],['node_id',$val]]);
                    if(is_null($vo)){
                        ModuleNode::addModuleNode(['module_id'=>$id,'node_id'=>$val]);//不存在则添加数据
                    }else{
                        continue;//存在则跳过;
                    }
                    unset($vo);
                }
                //删除这次去掉的节点
                ModuleNode::removeEditNodes($id,$nodes);

                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'编辑了功能模块'.$module_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑功能模块失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑功能模块成功', 'status' => '1']);
        }
    }
    //软删除模块
    public function module_delete(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            Module::where('id',$id)->delete();
            ModuleNode::deleteModuleNode($id);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'删除了功能模块，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除功能模块失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除功能模块成功', 'status' => '1']);
    }

    //硬删除模块
    public function module_remove(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            Module::where('id',$id)->forceDelete();
            ModuleNode::removeModuleNode($id);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'强制删除了功能模块，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '强制删除了功能模块，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '强制删除功能模块成功', 'status' => '1']);
    }
}
?>