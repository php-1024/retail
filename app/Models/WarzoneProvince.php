<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WarzoneProvince extends Model{
    use SoftDeletes;
    protected $table = 'warzone_province';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //添加战区
    public static function  WarzoneProvinceAdd($param)
    {
        $model = new WarzoneProvince();
        $model->zone_id = $param['zone_id'];
        $model->province_id = $param['province_id'];
        $model->save();
        return $model->id;
    }
    //获取单行数据
    public static function getOne($where){
        return self::where($where)->first();
    }
    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
    //彻底删除战区包含省份
    public static function WarzoneProvinceDelete($zone_id){
        Self::where(['zone_id'=>$zone_id])->forceDelete();
    }
}
?>