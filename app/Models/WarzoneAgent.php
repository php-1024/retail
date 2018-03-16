<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WarzoneAgent extends Model{
    use SoftDeletes;
    protected $table = 'warzone_agent';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和Organization表一对一的关系
//    public function organization(){
//        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
//    }

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }
    //添加数据
    public static function addWarzoneProxy($param){
        $program = new WarzoneAgent();//实例化程序模型
        $program->zone_id = $param['zone_id'];//程序名称
        $program->organization_id = $param['organization_id'];//程序名称
        $program->save();
        return $program->id;
    }
    //修改数据
    public static function editWarzoneProxy($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
}
?>