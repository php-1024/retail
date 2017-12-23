<?php
/**
 * program_login_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingLoginLog extends Model{
    protected $table = 'tooling_login_log';
    protected $primaryKey = 'id';//主键ID
    public $timestamps = true;//是否使用时间戳
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

    public function addLoginLog($account_id,$ip,$addr){
        $loginlog = new ToolingLoginLog();
        $loginlog->account_id = $account_id;
        $loginlog->ip = $ip;
        $loginlog->ip_position = $addr;
        $loginlog->save();
        $id = $loginlog->id;
        if(empty($id)){
            return false;
        }else{
            return true;
        }
    }
}
?>