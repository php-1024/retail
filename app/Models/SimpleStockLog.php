<?php
/**
 * simple_stock_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SimpleStockLog extends Model{
    use SoftDeletes;
    protected $table = 'simple_stock_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和SimpleStockLog表一对多的关系
    public function SimpleGoods(){
        return $this->belongsTo('App\Models\SimpleGoods','order_id','id');
    }

    //添加库存
    public static function addStockLog($param){
        $model = new SimpleStockLog();
        $model->goods_id = $param['goods_id'];
        $model->amount = $param['amount'];
        $model->ordersn = $param['ordersn'];
        $model->operator_id = $param['operator_id'];
        $model->remark = $param['remark'];
        $model->type = $param['type'];
        $model->status = $param['status'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->simple_id = $param['simple_id'];
        $model->save();
        return $model->id;
    }
}
?>