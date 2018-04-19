<?php
/**
 * simple_goods_thumb表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SimpleGoodsThumb extends Model{
    use SoftDeletes;
    protected $table = 'simple_goods_thumb';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和商品表SimpleGoods表多对一的关系
    public function SimpleGoods(){
        return $this->belongsto('App\Models\SimpleGoods','goods_id','id');
    }

    //获取单条数据
    public static function getOne($where)
    {
        return self::with('SimpleGoods')->where($where)->first();
    }

    //获取餐饮商品图片列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new SimpleGoodsThumb();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->with('SimpleGoods')->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品图片
    public static function addGoodsThumb($param){
        $model = new SimpleGoodsThumb();
        $model->goods_id = $param['goods_id'];
        $model->thumb = $param['thumb'];
        $model->save();
        return $model->id;
    }


    //查询出模型，再删除模型 一定要查询到才能删除
    public static function deleteGoodsThumb($id){
        $model = Self::find($id);
        return $model->delete();
       // forceDelete
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

    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }



}
?>