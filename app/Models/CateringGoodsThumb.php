<?php
/**
 * catering_goods_thumb表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringGoodsThumb extends Model{
    use SoftDeletes;
    protected $table = 'catering_goods_thumb';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和商品表catering_goods表一对多的关系
    public function catering_goods(){
        return $this->hasMany('App\Models\CateringGoods','id');
    }

    //获取单条数据
    public static function getOne($where)
    {
        return self::with('catering_goods')->where($where)->first();
    }

    //获取餐饮商品图片列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringGoodsThumb();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->with('catering_goods')->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品图片
    public static function addGoodsThumb($param){
        $model = new CateringGoodsThumb();
        $model->goods_id = $param['goods_id'];
        $model->thumb = $param['thumb'];
        $model->save();
        return $model->id;
    }


    //查询出模型，再删除模型 一定要查询到才能删除
    public static function deleteGoodsThumb($id){
        $model = Self::find($id);
        return $model->delete();
    }
    
    //修改餐饮商品图片数据
    public static function editGoodsThumb($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

}
?>