<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingAccount extends Model{
    protected $table = 'tooling_account';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function login_logs(){
        return $this->hasMany('App\Models\ToolingLoginLog', 'account_id');
    }

    public function operation_logs(){
        return $this->hasMany('App\Models\ToolingOperationLog', 'account_id');
    }
    //简易型查询单条数据
    public static function getOne($where)
    {
        return self::where($where)->where('is_delete','0')->first();
    }
    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where){
        $row = self::where($where)->where('is_delete','0')->pluck('id')->toArray();
        if(empty($row)){
            return false;
        }else{
            return true;
        }
    }

}
?>