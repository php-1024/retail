<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model{
    use SoftDeletes;
    protected $table = 'account';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式
    //和organization表多对一的关系
    public function organization(){
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }
    //和权限角色表创建者一对多的关系
    public function roles(){
        return $this->hasMany('App\Models\OrganizationRole', 'created_by');
    }
    //简易型查询单条数据
    public static function getOne($where)
    {
        return self::with('organization')->where($where)->first();
    }
    //登陆时通过输入的用户名或手机号查询用户
    public static function getOneForLogin($username){
        return self::where('account',$username)->orWhere('mobile',$username)->first();
    }

    public static function addAccount($param){

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