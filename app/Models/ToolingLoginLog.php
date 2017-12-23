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

    //关联程序管理工具账户表
    public function accounts(){
        return $this->belongsTo('App\Models\ToolingAccount', 'account_id');
    }

    //查询获取列表
    public static function getList($where,$limit,$orderby,$sort='DESC'){
        return self::with('accounts')->where($where)->where('is_delete','0')->limit($limit)->orderBy($orderby,$sort)->get();
    }

    public static function addLoginLog($account_id,$ip,$addr){
        $loginlog = new ToolingLoginLog();//新建模型
        $loginlog->account_id = $account_id;//用户账号ID
        $loginlog->ip = $ip;//登录IP
        $loginlog->ip_position = $addr;//登录地址
        $loginlog->save();//保存数据
        $id = $loginlog->id;//获取插入ID
        if(empty($id)){
            return false;
        }else{
            return true;
        }
    }
}
?>