<?php
/**
 * retail_order表的模型
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

    public static function getOne($where)
    {
        $model = self::with('User')->with('RetailGoods');
        return $model->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RetailStockLog();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //获取分页列表
    public static function getPaginage($where,$search_data,$paginate,$orderby,$sort='DESC'){
        $model = self::with('RetailGoods');
        if(!empty($search_data['user_id'])){
            $model = $model->where([['user_id',$search_data['user_id']]]);
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
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>