<?php
/**
 * role_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoleAccount extends Model{
    use SoftDeletes;
    protected $table = 'role_account';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和账号多对多的关系
    public function accounts()
    {
        return $this->belongsToMany('App\Models\Account','role_account','role_id','account_id');
    }

    //添加用户角色关系
    public static function addRoleAccount($param){
        $model = new RoleAccount();
        $model->account_id = $param['account_id'];
        $model->role_id = $param['role_id'];
        $model->save();
        return $model->id;
    }
}
?>