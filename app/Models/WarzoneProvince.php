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

    //和战区表一对一的关系
    public function warzone(){
        return $this->belongsTo('App\Models\Warzone', 'zone_id');
    }
    //和战区省份表一对一的关系
    public function province(){
//        return $this->belongsTo('App\Models\Province','province_id');
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
    //获取战区分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('province')->with('warzone')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

}
?>