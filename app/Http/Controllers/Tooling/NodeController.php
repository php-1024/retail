<?php
namespace App\Http\Controllers\Tooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Libraries\ZeroneLog\ToolingLog;

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

        if(Node::checkRowExists([[ 'node_name',$node_name ]])){
            return response()->json(['data' => '节点名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                Node::addNode(['node_name'=>$node_name,'route_name'=>$route_name]);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$current_route_name,'新增了节点'.$node_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加账号失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加节点成功', 'status' => '1']);
        }
    }
    //节点列表
    public function node_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $node = new Node();
        $node_name = $request->input('node_name');
        $search_data = ['node_name'=>$node_name];
        if(!empty($node_name)){
            $node = $node->where('node_name','like','%'.$node_name.'%');
        }
        $list = $node->paginate(15);
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
        $search_data = ['node_name'=>$node_name,'route_name'=>$route_name];

        $node = new Node();
        $node = $node->where('id','!=',$id);
        $info = $node->where(function($query) use($search_data){
            $query->where('node_name',$search_data['node_name']);
            $query->orWhere('route_name',$search_data['route_name']);
        })->pluck('id')->toArray();//查询除了本ID的是否有相同的节点名称或路由名称存在

        if(!empty($info)){
            return response()->json(['data' => '节点名称或路由名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $node = new Node();//重新实例化模型，避免重复
                $node->where('id',$id)->update(['node_name'=>$node_name,'route_name'=>$route_name]);//添加账号
                ToolingLog::setOperationLog($admin_data['admin_id'],$current_route_name,'修改了节点'.$node_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '修改节点失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '修改节点成功', 'status' => '1']);
        }
    }
}
?>