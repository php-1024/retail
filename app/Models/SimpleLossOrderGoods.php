<?php
/**
 * simple_loss_order_goods表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SimpleLossOrderGoods extends Model{
    use SoftDeletes;
    protected $table = 'simple_loss_order_goods';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式


    //和SimpleLossOrder表多对一的关系
    public function SimpleLossOrder(){
        return $this->belongsTo('App\Models\SimpleLossOrder', 'order_id','id');
    }

    public static function getOne($where)
    {
        $model = self::with('SimpleLossOrder');
        return $model->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new SimpleLossOrderGoods();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->with('SimpleLossOrder')->where($where)->orderBy($orderby,$sort)->get();
    }

    //保存创建订单的商品快照数据
    public static function addOrderGoods($param){
        $model = new SimpleLossOrderGoods();
        $model->order_id = $param['order_id'];
        $model->goods_id = $param['goods_id'];
        $model->title = $param['title'];
        $model->thumb = $param['thumb'];
        $model->details = $param['details'];
        $model->total = $param['total'];
        $model->price = $param['price'];
        $model->save();
        return $model->id;
    }

    //修改数据
    public static function editOrder($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('SimpleLossOrder')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>