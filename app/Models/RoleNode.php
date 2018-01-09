<?php
/**
 * role_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoleNode extends Model{
    use SoftDeletes;
    protected $table = 'role_node';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //修改数据
    public static function editRoleNode($where,$param)
    {
        if ($model = self::where($where)->first()) {
            foreach ($param as $key => $val) {
                $model->$key = $val;
            }
            $model->save();
        }
    }

    //添加角色节点
    public static function addRoleNode($param){
        $model = new RoleNode();
        $model->role_id = $param['role_id'];
        $model->node_id = $param['node_id'];
        $model->save();
        return $model->id;
    }

    //获取带程序模块节点名称的列表
    public static function getModuleNodes($role_id,$program_id){
        return self::where('role_id',$role_id)->join('program_module_node',function($query) use($program_id){
            $query->on('program_module_node.node_id','role_node.node_id')->join('module',function($query2){
                $query2->on('module.id','program_module_node.module_id');
            })->where('program_id',$program_id);
        })->select('role_node.*','program_module_node.module_id')->get();
    }
    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RoleNode();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }
}
?>