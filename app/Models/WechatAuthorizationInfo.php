<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatAuthorizationInfo extends Model{
    use SoftDeletes;
    protected $table = 'wechat_authorization_info';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    public static function addInfo($param){
        $model = new WechatAuthorizationInfo();
        $model->organization_id = $param['organization_id'];
        $model->authorizer_appid = $param['authorizer_appid'];
        $model->authorizer_access_token = $param['authorizer_access_token'];
        $model->authorizer_refresh_token = $param['authorizer_refresh_token'];
        $model->origin_data = $param['origin_data'];
        $model->status = $param['status'];
        $model->expire_time = $param['expire_time'];
        $model->save();
        return $model->id;
    }

    public static function editInfo($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }
}
?>