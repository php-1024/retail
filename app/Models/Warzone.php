<?php
/**
 * program表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Warzone extends Model{
    use SoftDeletes;
    protected $table = 'warzone';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和proxyappy表一对多的关系
//    public function warzone_agent(){
//        return $this->hasMany('App\Models\warzone_agent', 'zone_id');
//    }
    //和WarzoneProxy表一对多的关系
    public function WarzoneAgent(){
        return $this->hasMany('App\Models\WarzoneAgent', 'zone_id');
    }

    //获取单行数据
    public static function getOne($where){
        return self::with('province')->where($where)->first();
    }

    //和战区节点关联，多对多
    public function province()
    {
        return $this->belongsToMany('App\Models\Province','warzone_province','zone_id','province_id');
    }
    //获取战区分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='ASC'){
        return self::with('province')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //添加战区
    public static function WarzoneAdd($param)
    {
        $model = new Warzone();
        $model->zone_name = $param;
        $model->save();
        return $model->id;
    }

    //修改战区
    public static function WarzoneEdit($where,$param)
    {
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

}
?>