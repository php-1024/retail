<?php
/**
 * spec表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringSpec extends Model{
    use SoftDeletes;
    protected $table = 'catering_spec';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和规格项目catering_spec_item表一对多的关系
    public function catering_spec_item(){
        return $this->hasMany('App\Models\CateringSpecItem','spec_id');
    }

    //获取单条数据
    public static function getOne($where)
    {
        return self::with('catering_spec_item')->where($where)->first();
    }

    //获取餐饮商品规格列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringSpec();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->with('catering_spec_item')->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品
    public static function addCateringSpec($param){
        $model = new CateringSpec();
        $model->name = $param['name'];
        $model->goods_id = $param['goods_id'];
        $model->save();
        return $model->id;
    }


    //查询出模型，再删除模型 一定要查询到才能删除
    public static function deleteCateringSpec($id){
        $model = Self::find($id);
        return $model->delete();
    }
    
    //修改餐饮商品规格数据
    public static function editCateringSpec($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

}
?>