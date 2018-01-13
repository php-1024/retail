<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WarzoneProxy extends Model{
    use SoftDeletes;
    protected $table = 'warzone_proxy';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和战区表一对一的关系
    public function warzone(){
        return $this->belongsTo('App\Models\Warzone', 'zone_id');
    }
    //和战区省份表一对一的关系
    public function province(){
        return $this->belongsTo('App\Models\Province','province_name');
    }
    //添加数据
    public static function addWarzoneProxy($param){
        $program = new WarzoneProxy();//实例化程序模型
        $program->zone_id = $param['zone_id'];//程序名称
        $program->organization_id = $param['organization_id'];//程序名称
        $program->save();
        return $program->id;
    }
}
?>