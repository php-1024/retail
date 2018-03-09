<?php
/**
 * program_module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProgramModuleNode extends Model{
    use SoftDeletes;
    protected $table = 'program_module_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }

    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new ProgramModuleNode();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    public static function addProgramModuleNode($param){
        $model = new ProgramModuleNode();
        $model->program_id = $param['program_id'];
        $model->module_id = $param['module_id'];
        $model->node_id = $param['node_id'];
        $model->p_m_n = $param['program_id'].'_'.$param['module_id'].'_'.$param['node_id'];
        $model->save();
    }

    //获取权限角色拥有的模块和节点
    public static function getRoleModuleNodes($program_id,$role_id){
        return self::join('module',function($query){
            $query->on('program_module_node.module_id','module.id');
        })->join('node',function($query){
            $query->on('program_module_node.node_id','node.id');
        })->whereIn('node_id',function($query) use($role_id){
            $query->from('role_node')->select('node_id')->where('role_id',$role_id);
        })->where('program_id',$program_id)->select('program_module_node.*','module.module_name','module.module_show_name','module.id','node.node_name','node.node_show_name','node.id')->get();
    }

    //获取用户拥有的模块和节点
    public static function getAccountModuleNodes($program_id,$account_id){
        return self::join('module',function($query){
            $query->on('program_module_node.module_id','module.id');
        })->join('node',function($query){
            $query->on('program_module_node.node_id','node.id');
        })->whereIn('node_id',function($query) use($account_id){
            $query->from('account_node')->select('node_id')->where('account_id',$account_id);
        })->where('program_id',$program_id)->select('program_module_node.*','module.module_name','module.id','node.node_name','node.id')->get();
    }

    //修改数据
    public static function editProgramModuleNode($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //删除节点时，同时删除节点与程序的关联
    public static function deleteNode($node_id){
        return self::where('node_id',$node_id)->delete();
    }

    //删除节点时，同时删除节点与程序的关联
    public static function removeNode($node_id){
        return self::where('node_id',$node_id)->forceDelete();
    }

    //程序编辑去掉了节点，同时去掉节点。
    public static function deleteProgramModuleNode($program_id,$p_m_ns){
        $nodes = self::where('program_id', $program_id)->whereNotIn('p_m_n', $p_m_ns)->get();
        $unselectedNodes = [];//用于存储此次去除的ID
        foreach($nodes as $key=>$val){
            $unselectedNodes[] = $val['node_id'];
        }
        dump($unselectedNodes);
    }

}
?>