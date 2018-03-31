<?php
/**
 * retail_stock表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailStock extends Model{
    use SoftDeletes;
    protected $table = 'retail_stock';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和零售分类RetailGoods表一对多的关系
    public function RetailGoods(){
        return $this->hasOne('App\Models\RetailGoods','goods_id','id');
    }

    //和零售分类RetailGoods表一对多的关系
    public function RetailCategory(){
        return $this->hasOne('App\Models\RetailCategory','category_id','id');
    }

    //添加库存
    public static function addStock($param){
        $model = new RetailStock();
        $model->category_id = $param['category_id'];
        $model->goods_id = $param['goods_id'];
        $model->stock = $param['stock'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->retail_id = $param['retail_id'];
        $model->save();
        return $model->id;
    }
    //修改库存
    public static function editStock($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$goods_id,$paginate,$orderby,$sort='DESC'){
        $model = new RetailStock();
        if(!empty($goods_id)){
            $model = $model->where(['id'=>$goods_id]);
        }
        return $model->with('RetailGoods')->with('RetailCategory')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //查询出模型，再删除模型 一定要查询到才能删除
    public static function select_delete($id){
        $model = Self::find($id);
        return $model->delete();
    }
}
?>