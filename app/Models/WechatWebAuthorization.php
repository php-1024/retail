<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatWebAuthorization extends Model{
    use SoftDeletes;
    protected $table = 'wechat_web_authorization';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    public static function addAuthorization($param){
        $model = new WechatWebAuthorization();
        $model->access_token = $param['access_token'];
        $model->refresh_token = $param['refresh_token'];
        $model->expire_time = $param['expire_time'];
        $model->expire_time_refresh = $param['expire_time_refresh'];
        $model->save();
        return $model->id;
    }
    public static function editAuthorization($where,$param){
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