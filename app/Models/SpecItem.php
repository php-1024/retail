<?php
/**
 * spec_item表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SpecItem extends Model{
    use SoftDeletes;
    protected $table = 'spec_item';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者CateringGoods表多对一的关系
    public function spec(){
        return $this->belongsto('App\Models\Spec','spec_id');
    }

    //获取单条餐饮商品信息
    public static function getOne($where){
        return self::with('spec')->where($where)->first();
    }

    //获取餐饮商品规格列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new SpecItem();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品子规格
    public static function addSpecItem($param){
        $model = new SpecItem();
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

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('spec')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>