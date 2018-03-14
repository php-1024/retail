<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatAuthorizerInfo extends Model{
    use SoftDeletes;
    protected $table = 'wechat_authorizer_info';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    public static function addAuthorizerInfo($param){
        $model = new WechatWebAuthorization();
        $model->authorization_id = $param['authorization_id'];
        $model->nickname = $param['nickname'];
        $model->head_img = $param['head_img'];
        $model->service_type_info = $param['service_type_info'];
        $model->verify_type_info = $param['verify_type_info'];
        $model->user_name = $param['user_name'];
        $model->principal_name = $param['principal_name'];
        $model->alias = $param['alias'];
        $model->business_info = $param['business_info'];
        $model->qrcode_url = $param['qrcode_url'];
        $model->save();
        return $model->id;
    }
    public static function editAuthorizerInfo($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
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