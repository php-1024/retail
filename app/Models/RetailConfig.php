<?php
/**
 * retail_config表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailConfig extends Model{
    use SoftDeletes;
    protected $table = 'retail_config';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }

    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::where($where);
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->orderBy($orderby,$sort)->get();
    }


    //修改数据
    public static function editRetailConfig($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //添加数据
    public static function addRetailConfig($param){
        $model = new RetailConfig();
        $model->retail_id = $param['retail_id'];//组织ID
        $model->cfg_name = $param['cfg_name'];//配置项名
//        $model->cfg_value = $param['cfg_value'];//配置项状态值
        $model->save();
        return $model->id;
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