<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatOpenSetting extends Model{
    use SoftDeletes;
    protected $table = 'wechat_open_setting';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public static function editComponentVerifyTicket($value,$expire_time){
        $param = [
            'value'=>$value,
            'expire_time'=>$expire_time,
        ];
        self::editSetting([['id',1]],$param);
    }


    public static function editSetting($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }
}
?>