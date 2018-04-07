<?php
/**
 * retail_order表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailOrder extends Model{
    use SoftDeletes;
    protected $table = 'retail_order';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和User表多对一的关系
    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    //和RetailOrderGoods表一对多的关系
    public function RetailOrderGoods(){
        return $this->hasMany('App\Models\RetailOrderGoods','order_id','id');
    }

    public static function getOne($where)
    {
        $model = self::with('User')->with('RetailOrderGoods');
        return $model->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC',$select=[]){
        $model = new RetailOrder();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        if(!empty($select)){
            $model = $model->select($select);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }


    //修改订单信息
    public static function editRetailOrder($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }


    //添加数据
    public static function addRetailOrder($param){
        $retailorder = new RetailOrder();//实例化程序模型
        $retailorder->ordersn = $param['ordersn'];//订单编号
        $retailorder->order_price = $param['order_price'];//订单价格
        $retailorder->user_id = $param['user_id'];//订单人id
        $retailorder->order_type = $param['order_type'];//订单类型
        $retailorder->status = $param['status'];//订单状态
        $retailorder->operator_id = $param['operator_id'];//操作人员id
        $retailorder->fansmanage_id = $param['fansmanage_id'];//管理平台id
        $retailorder->retail_id = $param['retail_id'];//店铺所属组织ID
        if(!empty($param['paytype'])){
            $retailorder->paytype = $param['paytype'];//付款方式
        }
        if(!empty($param['remarks'])){
            $retailorder->remarks = $param['remarks'];//备注信息
        }
        $retailorder->save();
        return $retailorder->id;
    }

    //获取分页列表
    public static function getPaginage($where,$search_data,$paginate,$orderby,$sort='DESC'){
        $model = self::with('User');
        if(!empty(!empty($search_data['ordersn']) && $search_data['user_id']) && !empty($search_data['paytype']) && !empty($search_data['status'])){
            //如果存在用户账号，订单号码，支付方式，，以及订单状态
            $model = $model->where(['user_id'=>$search_data['user_id']],['ordersn'=>$search_data['ordersn']]);
            return $model->with('RetailOrderGoods')->orderBy($orderby,$sort)->paginate($paginate);
        }elseif(!empty($search_data['user_id']) && !empty($search_data['paytype']) && !empty($search_data['status'])){
            //如果存在用户账号，支付方式，订单状态
            $model = $model->where(['user_id'=>$search_data['user_id'],['paytype'=>$search_data['paytype']],['status'=>$search_data['status']]]);
            return $model->with('RetailOrderGoods')->orderBy($orderby,$sort)->paginate($paginate);
        }elseif(!empty($search_data['user_id']) && !empty($search_data['paytype'])){
            //如果存在用户账号，支付方式
            $model = $model->where(['user_id'=>$search_data['user_id'],['paytype'=>$search_data['paytype']]]);
            return $model->with('RetailOrderGoods')->orderBy($orderby,$sort)->paginate($paginate);
        }elseif(!empty($search_data['user_id']) && !empty($search_data['status'])){
            //如果存在用户账号，支付方式
            $model = $model->where(['user_id'=>$search_data['user_id'],['status'=>$search_data['status']]]);
            return $model->with('RetailOrderGoods')->orderBy($orderby,$sort)->paginate($paginate);
        }else{
            return $model->with('RetailOrderGoods')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
        }

    }

    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
}
?>