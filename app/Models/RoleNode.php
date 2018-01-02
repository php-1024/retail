<?php
/**
 * role_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RoleNode extends Model{
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

    //删除角色节点关系表
}
?>