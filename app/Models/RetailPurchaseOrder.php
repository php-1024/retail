<?php
/**
 * retail_purchase_order表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailPurchaseOrder extends Model{
    use SoftDeletes;
    protected $table = 'retail_purchase_order';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和BillingController表多对一的关系
    public function RetailSupplier(){
        return $this->belongsTo('App\Models\RetailSupplier','company_id','id');
    }

    //和RetailOrderGoods表一对多的关系
    public function RetailPurchaseOrderGoods(){
        return $this->hasMany('App\Models\RetailPurchaseOrderGoods','order_id','id');
    }

    //创建订单
    public static function addOrder($param){
        $model = new RetailPurchaseOrder();
        $model->ordersn = $param['ordersn'];
        $model->order_price = $param['order_price'];
        $model->remarks = $param['remarks'];
        $model->company_id = $param['company_id'];
        $model->operator_id = $param['operator_id'];
        $model->type = $param['type'];
        $model->status = '0';
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->retail_id = $param['retail_id'];
        $model->save();
        return $model->id;
    }


    public static function getOne($where)
    {
        $model = self::with('BillingController')->with('RetailPurchaseOrderGoods');
        return $model->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RetailPurchaseOrder();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //获取分页列表
    public static function getPaginage($where,$search_data,$paginate,$orderby,$sort='DESC'){
        $model = self::with('BillingController');
        if(!empty($search_data['company_id'])){
            $model = $model->where([['company_id',$search_data['company_id']]]);
        }
        if(!empty($search_data['ordersn'])){
            $model = $model->where([['ordersn',$search_data['ordersn']]]);
        }
        if(!empty($search_data['paytype'])){
            $model = $model->where([['paytype',$search_data['paytype']]]);
        }
        if(!empty($search_data['status'])){
            $model = $model->where([['status',$search_data['status']]]);
        }
        return $model->with('RetailPurchaseOrderGoods')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>