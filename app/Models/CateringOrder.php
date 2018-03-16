<?php
/**
 * catering_order表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringOrder extends Model{
    use SoftDeletes;
    protected $table = 'catering_order';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和User表多对一的关系
    public function User(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public static function getOne($where)
    {
        $model = self::with('User');
        return $model->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringOrder();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加组织栏目分类
    public static function addOrder($param){
        $model = new CateringOrder();
        $model->name = $param['name'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->restaurant_id = $param['restaurant_id'];
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
        return self::with('account')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>