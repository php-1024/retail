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
use App\Models\ProgramMenu;
use App\Models\AccountNode;

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
        $program_url = $request->input('program_url');//程序路由
        $complete_id = $request->input('complete_id');//上级程序
        $is_asset = empty($request->input('is_asset'))?'0':'1';//是否资产程序
        $module_node_ids = $request->input('module_node_ids');//节点数组
        if(Program::checkRowExists([[ 'program_name',$program_name ]])){
            return response()->json(['data' => '程序名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                $program_id = Program::addProgram(['program_name'=>$program_name,'program_url'=>$program_url,'complete_id'=>$complete_id,'is_asset'=>$is_asset]);

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
        $pname = [];//上级程序名称列表
        foreach($list as $key=>$val){
            $program_id = $val->id;
            $module_list[$val->id] =Module::getListProgram($program_id,[],0,'id');
            $ppname = Program::getPluck([['id',$val->complete_id]],'program_name')->toArray();//获取用户名称
            if(empty($ppname)){
                $pname[$val->id] = '独立主程序';
            }else{
                $pname[$val->id] = $ppname[0];
            }
        }
        return view('Tooling/Program/program_list',['list'=>$list,'search_data'=>$search_data,'module_list'=>$module_list,'pname'=>$pname,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
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
        $program_url = $request->input('program_url');//程序路由
        $complete_id = $request->input('complete_id');//上级程序
        $is_asset = empty($request->input('is_asset'))?'0':'1';//是否资产程序
        $module_node_ids = $request->input('module_node_ids');//节点数组


        if(Program::checkRowExists([[ 'program_name',$program_name],['id','!=',$id]])){
            return response()->json(['data' => '程序名称已经存在', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                Program::editProgram([[ 'id',$id ]],['program_name'=>$program_name,'program_url'=>$program_url,'complete_id'=>$complete_id,'is_asset'=>$is_asset]);
                $p_m_ns = [];
                $new_nodes = [];
                //循环节点生成多条数据
                foreach($module_node_ids as $key=>$val){
                    $arr = explode('_',$val);
                    $module_id = $arr[0];//功能模块ID
                    $node_id = $arr[1];//功能节点ID
                    $p_m_ns[] = $id.'_'.$module_id.'_'.$node_id;

                    $vo = ProgramModuleNode::getOne([['program_id',$id],['module_id',$module_id],['node_id',$node_id]]);//查询是否存在数据
                    if(is_null($vo)) {//不存在生成插入数据
                        $new_nodes[] = $node_id;
                        ProgramModuleNode::addProgramModuleNode(['program_id' => $id, 'module_id' => $module_id, 'node_id' => $node_id]);
                    }else{
                        continue;
                    }
                    unset($vo);
                }

                //添加的节点添加到该程序中所有主找好中
                AccountNode::addNewsNode($id,$new_nodes);
                //删除数据库中不在这次插入的数据

                //ProgramModuleNode::where('program_id', $id)->whereNotIn('p_m_n', $p_m_ns)->forceDelete();
                ProgramModuleNode::deleteProgramModuleNode($id,$p_m_ns);//删除
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'编辑了程序'.$program_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                dd($e);
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑程序失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑程序成功', 'status' => '1']);
        }
    }
    //获取编辑获取
    public function menu_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $info = Program::find($id);
        $list = ProgramMenu::getList([[ 'parent_id',0],['program_id',$id]],0,'displayorder','asc');
        $son_menu = [];
        $third_menu = [];
        foreach($list as $key=>$val){
            $son_menu[$val->id] = ProgramMenu::son_menu($val->id);
            foreach( $son_menu[$val->id] as $k => $v){
                $third_menu[$v->id] = ProgramMenu::son_menu($v->id);
            }
        }
        return view('Tooling/Program/menu_list',['list'=>$list,'son_menu'=>$son_menu,'third_menu'=>$third_menu,'info'=>$info,'admin_data'=>$admin_data,'route_name'=>$route_name,'action_name'=>'program']);
    }
    //添加菜单页面
    public function menu_add(Request $request){
        $id = $request->input('program_id');
        $info = Program::find($id);
        $list = ProgramMenu::getList([[ 'parent_id',0],['program_id',$id]],0,'id','asc');
        return view('Tooling/Program/menu_add',['list'=>$list,'info'=>$info,'action_name'=>'program']);
    }
    //获取二级菜单
    public function menu_second_get(Request $request){
        $parent_id = $request->input('parent_id');
        $program_id = $request->input('program_id');
        $list = ProgramMenu::getList([[ 'parent_id',$parent_id],['program_id',$program_id]],0,'id','asc');
        return response()->json(['data' =>$list, 'status' => 1]);
    }
    //添加菜单数据检测
    public function menu_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $program_id = $request->input('program_id');//所属程序ID
        $parent_id = $request->input('parent_id');//上级菜单ID
        $parent_tree = $parent_id=='0' ? '0' : ProgramMenu::getPluck([[ 'id',$parent_id]],'parent_tree')->toArray()[0].','.$parent_id;
        $menu_name = $request->input('menu_name');//菜单名称
        $is_root = $request->input('is_root');//是否根菜单
        $icon_class = empty($request->input("icon_class"))?'':$request->input("icon_class");//ICON样式名称
        $menu_route = empty($request->input("menu_route"))?'':$request->input("menu_route");//跳转路由
        $menu_routes_bind = empty($request->input("menu_routes_bind"))?'':$request->input("menu_routes_bind");//关联路由字符串，使用逗号分隔

        if(ProgramMenu::checkRowExists([[ 'menu_name',$menu_name ],['parent_id',$parent_id],['program_id',$program_id]])){
            return response()->json(['data' => '菜单组中菜单名称重复', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                ProgramMenu::addMenu(['program_id'=>$program_id,'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'menu_name'=>$menu_name,'is_root'=>$is_root,'icon_class'=>$icon_class,'menu_route'=>$menu_route,'menu_routes_bind'=>$menu_routes_bind]);
                ProgramMenu::refreshMenuCache($program_id);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'添加了菜单'.$menu_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加菜单失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加菜单成功', 'status' => '1']);
        }
    }
    //编辑菜单页面
    public function menu_edit(Request $request){
        $id = $request->input('id');
        $info = ProgramMenu::find($id);
        $parent_arr = explode(',',$info->parent_tree);
        $list = ProgramMenu::getList([[ 'parent_id',0],['program_id',$info->program_id]],0,'id','asc');

        $second_list = [];
        if(count($parent_arr)==3){
            $second_list  = ProgramMenu::getList([[ 'parent_id',$parent_arr[1]],['program_id',$info->program_id]],0,'id','asc');
        }
        return view('Tooling/Program/menu_edit',['parent_arr'=>$parent_arr,'list'=>$list,'second_list'=>$second_list,'info'=>$info,'action_name'=>'program']);
    }
    //编辑菜单数据检测
    public function menu_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $program_id = $request->input('program_id');//所属程序ID
        $parent_id = $request->input('parent_id');//上级菜单ID
        $parent_tree = $parent_id=='0' ? '0' : ProgramMenu::getPluck([[ 'id',$parent_id]],'parent_tree')->toArray()[0].','.$parent_id;
        $menu_name = $request->input('menu_name');//菜单名称
        $is_root = $request->input('is_root');//是否根菜单
        $icon_class = empty($request->input("icon_class"))?'':$request->input("icon_class");//ICON样式名称
        $menu_route = empty($request->input("menu_route"))?'':$request->input("menu_route");//跳转路由
        $menu_routes_bind = empty($request->input("menu_routes_bind"))?'':$request->input("menu_routes_bind");//关联路由字符串，使用逗号分隔

        if(ProgramMenu::checkRowExists([['id','<>',$id],[ 'menu_name',$menu_name ],['parent_id',$parent_id],['program_id',$program_id]])){
            return response()->json(['data' => '菜单组中菜单名称重复', 'status' => '0']);
        }else{
            DB::beginTransaction();
            try{
                ProgramMenu::editMenu([['id',$id]],['program_id'=>$program_id,'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'menu_name'=>$menu_name,'is_root'=>$is_root,'icon_class'=>$icon_class,'menu_route'=>$menu_route,'menu_routes_bind'=>$menu_routes_bind]);
                ProgramMenu::refreshMenuCache($program_id);
                ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'编辑了菜单'.$menu_name);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '编辑菜单失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '编辑菜单成功', 'status' => '1']);
        }
    }
    //编辑菜单排序
    public function menu_edit_displayorder(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $program_id = $request->input('program_id');//所属程序ID
        $displayorder = $request->input('displayorder');
        
        $program_info = Program::getPluck([['id',$program_id]],'program_name')->toArray();
        DB::beginTransaction();
        try{
            ProgramMenu::editMenu([['id',$id]],['displayorder'=>$displayorder]);
            ProgramMenu::refreshMenuCache($program_id);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'修改了'.$program_info[0].'的菜单排序');//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dump($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改菜单排序失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改菜单排序成功', 'status' => '1']);

    }
    //软删除模块
    public function menu_delete(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        $menu_info = ProgramMenu::getOne([['id',$id]]);
        DB::beginTransaction();
        try{
            ProgramMenu::deleteMenu([['id',$id]]);
            ProgramMenu::refreshMenuCache($menu_info['program_id']);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'删除了菜单，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除菜单成功', 'status' => '1']);
    }
    //软删除模块
    public function menu_remove(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        $menu_info = ProgramMenu::getOne([['id',$id]]);
        DB::beginTransaction();
        try{
            ProgramMenu::removeMenu([['id',$id]]);
            ProgramMenu::refreshMenuCache($menu_info['program_id']);
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'彻底删除了菜单，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '彻底删除菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '彻底删除菜单成功', 'status' => '1']);
    }

    //软删除程序
    public function program_delete(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            Program::where('id',$id)->delete();//删除该程序
            ProgramModuleNode::where('program_id',$id)->delete();//删除程序模块节点表相关数据
            ProgramMenu::where('program_id',$id)->delete();//删除程序菜单
            Program::editProgram([[ 'complete_id',$id]],['complete_id'=>'0']);//解除子程序与父程序的关系
            /*
             * 未完毕，待其他程序功能完善以后增加
             */
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'删除了菜单，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除菜单成功', 'status' => '1']);
    }

    //软删除程序
    public function program_remove(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//提交上来的ID
        DB::beginTransaction();
        try{
            Program::where('id',$id)->delete();//删除该程序
            ProgramModuleNode::where('program_id',$id)->forceDelete();//删除程序模块节点表相关数据
            ProgramMenu::where('program_id',$id)->forceDelete();//删除程序菜单
            Program::editProgram([[ 'complete_id',$id]],['complete_id'=>'0']);//解除子程序与父程序的关系
            /*
             * 未完毕，待其他程序功能完善以后增加
             */
            ToolingOperationLog::addOperationLog($admin_data['admin_id'],$route_name,'删除了菜单，ID为：'.$id);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除菜单成功', 'status' => '1']);
    }
}
?>