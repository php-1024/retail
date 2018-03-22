<?php
/**
 * program_error_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ToolingErrorLog extends Model{
    use SoftDeletes;
    protected $table = 'tooling_error_log';//数据表
    protected $primaryKey = 'id';//主键ID
    public $timestamps = true;//是否使用时间戳
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //简易型查询单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }

    //根据用户IP增加错误次数
    public static function addErrorTimes($ip){
        $error_log = self::where('ip',$ip)->first();//获取该IP的错误记录
        if(empty($error_log)){//没有错误记录，插入错误记录，有错误记录，更新错误记录
            $error_log = new ToolingErrorLog();//没有记录，新建一个模型，然后保存
            $error_log->ip = $ip;
            $error_log->error_time = 1;
            $error_log->save();
        }else{
            $error_log->error_time = $error_log->error_time+1;
            $error_log->save();
        }
    }

    //登录成功错误记录清0
    public static function clearErrorTimes($ip){
        self::where('ip',$ip)->update(['error_time'=>0]);
    }

}
?>