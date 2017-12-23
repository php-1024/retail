<?php
/**
 * program_error_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingErrorLog extends Model{
    protected $table = 'tooling_error_log';//数据表
    protected $primaryKey = 'id';//主键ID
    public $timestamps = true;//是否使用时间戳
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

    //简易型查询单条数据
    public static function getOne($where){
        return self::where($where)->first();
    }

    //根据用户IP增加错误次数
    public function addErrorTimes($ip){
        $model = new ToolingErrorLog();
        $error_log = $this->where('ip',$ip)->first();//获取该IP的错误记录
        if(empty($error_log)){//没有错误记录，插入错误记录，有错误记录，更新错误记录
            $model->error_time = 1;
            $model->save();
        }else{
            $model->error_time = $this->error_time+1;
            $model->save();
        }
    }
}
?>