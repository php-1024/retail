<?php
namespace App\Http\Controllers\Tooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Models\ModuleNode;
use App\Models\ProgramModuleNode;
use App\Models\ProgramMenu;
use App\Models\ToolingOperationLog;
use App\Models\RoleNode;
use App\Models\AccountNode;

class NodeController extends Controller{
    //添加节点
    public function node_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Tooling/Node/node_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'node']);
    }
    //提交添加节点数据
    public function node_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由

        $node_name = $request->input('node_name');//提交上来的节点名称
        $route_name = $request->input('route_name');//提交上来的路由名称
        $node_show_name = $request->input('node_show_name');//提交上来的节点展示名称（可以重复）
        if(Node::checkRowExists([[ 'node_name',$node_name ]])){
            return response()->json(['data' => '节点名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                Node::addNode(['node_name'=>$node_name,'node_show_name'=>$node_show_name,'route_name'=>$route_name]);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$current_route_name,'新增了节点'.$node_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加节点失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加节点成功', 'status' => '1']);
        }
    }
    //节点列表
    public function node_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $node_name = $request->input('node_name');
        $search_data = ['node_name'=>$node_name];
        $list = Node::getPaginage([[ 'node_name','like','%'.$node_name.'%' ]],15,'id');
        return view('Tooling/Node/node_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'node']);
    }

    //编辑节点
    public function node_edit(Request $request){
        $id = $request->input('id');
        $info = Node::find($id);
        return view('Tooling/Node/node_edit',['info'=>$info]);
    }

    //提交编辑节点数据
    public function node_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由

        $id = $request->input('id');//提交上来的ID
        $node_name = $request->input('node_name');//提交上来的节点名称
        $route_name = $request->input('route_name');//提交上来的路由名称
        $node_show_name = $request->input('node_show_name');//提交上来的节点展示名称（允许重复）
        if(Node::checkRowExists([['id','<>',$id],[ 'node_name',$node_name ]])){
            return response()->json(['data' => '节点名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                Node::editNode([['id',$id]],['node_name'=>$node_name,'node_show_name'=>$node_show_name,'route_name'=>$route_name]);//编辑节点
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$current_route_name,'修改了节点'.$node_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '修改节点失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '修改节点成功', 'status' => '1']);
        }
    }

    //软删除节点
    public function node_delete(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        $info = Node::getOne([['id',$id]]);//获取要删除的节点信息

        DB::beginTransaction();
        try{
            ModuleNode::deleteNode($id);//删除模块与节点的关系
            ProgramModuleNode::deleteNode($id);//删除程序与节点的关系
            ProgramMenu::deleteNode($info['route_name']);

            RoleNode::deleteNode($id);//删除角色与节点的关系

            Node::where('id',$id)->delete();//删除节点
            /*
             * 未完毕，待其他程序功能完善以后增加
             */
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$current_route_name,'删除了节点，ID为：'.$id);//保存操作记录

            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除节点失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除节点成功', 'status' => '1']);
    }

    //强制删除节点
    public function node_remove(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            Node::where('id',$id)->forceDelete();
            ModuleNode::where('node_id',$id)->forceDelete();
            RoleNode::where('node_id',$id)->forceDelete();
            ProgramModuleNode::where('node_id',$id)->forceDelete();
            /*
             * 未完毕，待其他程序功能完善以后增加
             */
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$current_route_name,'强制删除了节点，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '强制删除节点失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '强制删除节点成功', 'status' => '1']);
    }
}
?>