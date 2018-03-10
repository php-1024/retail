<?php
/**
 * spec_item表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringSpecItem extends Model{
    use SoftDeletes;
    protected $table = 'catering_spec_item';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和餐饮规格表CateringSpec一对多的关系
    public function catering_spec(){
        return $this->belongsto('App\Models\CateringSpec','spec_id');
    }

    //获取餐饮商品规格列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringSpecItem();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品子规格
    public static function addSpecItem($param){
        $model = new CateringSpecItem();
        $model->name = $param['name'];
        $model->spec_id = $param['spec_id'];
        $model->save();
        return $model->id;
    }
    
    //修改餐饮商品数据
    public static function editSpecItem($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }
}
?>