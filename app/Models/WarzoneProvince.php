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


    //修改战区包含省份
    public static function WarzoneProvinceEdit($data,$zone_id){
        Self::where(['zone_id'=>$zone_id])->forceDelete();
        $db = new WarzoneProvince();
        foreach($data as $key=>$val) {
            $db->zone_id = $zone_id;
            $db->province_id = $val;
        }
        $res = $db->save();
        return $res;
    }
}
?>