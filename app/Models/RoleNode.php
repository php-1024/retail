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

    //获取单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }

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


    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RoleNode();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //删除节点时，同时删除节点与程序的关联
    public static function deleteNode($node_id){
        return self::where('node_id',$node_id)->delete();
    }
}
?>