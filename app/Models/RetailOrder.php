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
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RetailOrder();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加数据
    public static function addRetailOrder($param){
        $organization = new RetailOrder();//实例化程序模型
        $organization->organization_name = $param['organization_name'];//组织名称
        $organization->parent_id = $param['parent_id'];//多级组织的关系
        $organization->parent_tree = $param['parent_tree'];//上级程序
        $organization->program_id = $param['program_id'];//组织关系树
        $organization->asset_id = $param['asset_id'];//下级组织使用程序id（商户使用）
        $organization->type = $param['type'];//类型 2为服务商
        $organization->status = $param['status'];//状态 1-正常 0-冻结
        $organization->save();
        return $organization->id;
    }

    //获取分页列表
    public static function getPaginage($where,$search_data,$paginate,$orderby,$sort='DESC'){
        $model = self::with('User');
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
        return $model->with('RetailOrderGoods')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>