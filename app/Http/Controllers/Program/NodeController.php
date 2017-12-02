<?php
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Node;
use App\Libraries\ZeroneLog\ProgramLog;

class NodeController extends Controller{
    //修改个人密码
    public function add_node(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Program/Node/add_node',['admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'node']);
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
        return view('Program/Node/node_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'node']);
    }
    //提交修改个人密码数据
    public function check_add_node(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $current_route_name = $request->path();//获取当前的页面路由

        $node_name = $request->input('node_name');//提交上来的节点名称
        $route_name = $request->input('route_name');//提交上来的路由名称

        $node = new Node();
        $info = $node->where('node_name',$node_name)->orWhere('route_name',$route_name)->pluck('id')->toArray();//查询是否有相同的节点名称或路由名称存在
        if(!empty($info)){
            return response()->json(['data' => '节点名称或路由名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $node = new Node();//重新实例化模型，避免重复
                $node->node_name = $node_name;//节点名称
                $node->route_name = $route_name;//路由名称
                $node->save();//添加账号
                ProgramLog::setOperationLog($admin_data['admin_id'],$current_route_name,'新增了节点'.$node_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加账号失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加节点成功', 'status' => '1']);
        }
    }
}
?>