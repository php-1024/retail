<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ModuleNode extends Model{
    use SoftDeletes;
    protected $table = 'module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }
    
    //添加数据
    public static function addModuleNode($param){
        $model = new ModuleNode();
        $model->module_id = $param['module_id'];
        $model->node_id = $param['node_id'];
        $model->save();
    }

    //删除节点时，同时删除关系
    public static function deleteNode($node_id){
        return self::where('node_id',$node_id)->delete();
    }

    //删除节点时，同时删除关系
    public static function removeNode($node_id){
        return self::where('node_id',$node_id)->forceDelete();
    }

    //修改数据
    public static function editModuleNode($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //修改数据时 如果去掉了节点 就要删除对应的节点信息
    public static function deleteEditNodes($module_id,$nodes){
        $list =  self::where('module_id',$module_id)->whereNotIn('node_id',$nodes)->get();//查询出模块原有的，但是本次编辑去掉的所有节点
        $program_module_nodes = ProgramModuleNode::where('module_id',$module_id)->whereNotIn('node_id',$nodes)->get();//查询出与该模块关联的所有程序及 本次编辑中删除了的节点。

        $program_ids = [];//储存所有
        foreach($program_module_nodes as $key=>$val){
            $node_info = Node::where('id',$val['node_id'])->first();//获取对应节点的节点route_name
            //ProgramMenu::where('program_id',$val['program_id'])->where('menu_route',$node_info['route_name'])->forceDelete();//根据节点route_name删除对应程序中对应的菜单
            $program_ids[] = $val['program_id'];
        }

        $program_ids = array_unique($program_ids);//去重

        //查询该程序下的所有角色
        $role_list = OrganizationRole::whereIn('program_id',$program_ids)->get();
        foreach($role_list as $key=>$val){

        }
    }
}
?>