<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WechatImage extends Model{
    use SoftDeletes;
    protected $table = 'wechat_image';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    public static function WechatImage($param){
        $model = new WechatImage();
        $model->organization_id = $param['organization_id'];
        $model->filename = $param['filename'];
        $model->filepath = $param['filepath'];
        $model->media_id = $param['media_id'];
        $model->wechat_url = $param['wechat_url'];
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