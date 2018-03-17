<?php
/**
 * retail_goods表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailGoods extends Model{
    use SoftDeletes;
    protected $table = 'retail_goods';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者account表多对一的关系
    public function create_account(){
        return $this->belongsto('App\Models\Account','created_by','id');
    }

    //和创建者catering_category多对一的关系
    public function category(){
        return $this->belongsTo('App\Models\RetailCategory','category_id','id');
    }

    //和organization表一对一的关系
    public function organization(){
        return $this->belongsto('App\Models\Organization','retail_id','id');
    }

    //和RetailGoodsThumb表一对多的关系
    public function RetailGoodsThumb(){
        return $this->hasMany('App\Models\RetailGoodsThumb','goods_id','id');
    }

    //和RetailOrder表多对多的关系
    public function RetailOrder(){
        return $this->belongsToMany('App\Models\RetailOrder','retail_order_goods','goods_id','order_id');
    }

    //获取单条餐饮商品信息
    public static function getOne($where){
        return self::with('category')->with('RetailGoodsThumb')->where($where)->first();
    }

    //获取餐饮商品列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RetailGoods();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品
    public static function addRetailGoods($param){
        $model = new RetailGoods();
        $model->name = $param['name'];
        $model->details = $param['details'];
        $model->price = $param['price'];
        $model->stock = $param['stock'];
        $model->created_by = $param['created_by'];
        $model->category_id = $param['category_id'];
        $model->displayorder = $param['displayorder'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->retail_id = $param['retail_id'];
        $model->save();
        return $model->id;
    }
    
    //修改餐饮商品数据
    public static function editRetailGoods($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('create_account')->with('organization')->with('category')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //查询出模型，再删除模型 一定要查询到才能删除
    public static function select_delete($id){
        $model = Self::find($id);
        return $model->delete();
    }
}
?>