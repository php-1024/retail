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
    //简易型查询单条数据
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

}
?>