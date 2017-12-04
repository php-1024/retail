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
        $node_list = Node::all();
        return view('Program/Module/module_add',['node_list'=>$node_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
    //提交添加功能模块数据
    public function module_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $module_name  = $request->input('module_name');//获取功能模块名称
        $nodes = $request->input('nodes');//获取选择的节点

        $module = new Module();
        $info = $module->where('module_name',$module_name)->pluck('id')->toArray();
        if(!empty($info)){
            return response()->json(['data' => '节点名称或路由名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $modue_node = new ModuleNode();//重新实例化模型，避免重复
                $module = new Module();
                $module->module_name=$module_name;
                $module->save();
                $module_id = $module->id;
                foreach($nodes as $key=>$val){
                    $module_node_data[] = ['module_id'=>$module_id,'node_id'=>$val,'created_at'=>time(),'updated_at'=>time()];
                }
                $modue_node->insert($module_node_data);

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
        $list = $module->paginate(15);
        dump($list);
        return view('Program/Module/module_list',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'module']);
    }
}
?>