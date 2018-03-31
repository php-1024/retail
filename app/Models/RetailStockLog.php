<?php
/**
 * retail_stock_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailStockLog extends Model{
    use SoftDeletes;
    protected $table = 'retail_stock_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和RetailStockLog表一对多的关系
    public function RetailGoods(){
        return $this->belongsTo('App\Models\RetailGoods','order_id','id');
    }

    //添加库存
    public static function addStockLog($param){
        $model = new RetailStockLog();
        $model->goods_id = $param['goods_id'];
        $model->amount = $param['amount'];
        $model->ordersn = $param['ordersn'];
        $model->operator_id = $param['operator_id'];
        $model->remark = $param['remark'];
        $model->type = $param['type'];
        $model->status = $param['status'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->retail_id = $param['retail_id'];
        $model->save();
        return $model->id;
    }
}
?>