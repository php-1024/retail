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

    //修改账号与角色间的关系
    public static function editRoleAccount($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //添加用户角色关系
    public static function addRoleAccount($param){
        $model = new RoleAccount();
        $model->account_id = $param['account_id'];
        $model->role_id = $param['role_id'];
        $model->save();
        return $model->id;
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where){
        $row = self::getPluck($where,'id')->toArray();
        if(empty($row)){
            return false;
        }else{
            return true;
        }
    }
    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
}
?>