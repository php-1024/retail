<?php
/**
 * catering_goods表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringGoods extends Model{
    use SoftDeletes;
    protected $table = 'catering_goods';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者account表多对一的关系
    public function create_account(){
        return $this->belongsto('App\Models\Account','created_by');
    }

    //和创建者catering_category表多对一的关系
    public function category(){
        return $this->belongsto('App\Models\CateringCategory','category_id');
    }

    //获取单条餐饮商品信息
    public static function getOne($where){
        return self::with('category')->where($where)->first();
    }

    //获取餐饮商品列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringGoods();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加餐饮商品
    public static function addCateringGoods($param){
        $model = new CateringGoods();
        $model->program_id = $param['program_id'];
        $model->name = $param['name'];
//        $model->keywords = $param['keywords'];
        $model->details = $param['details'];
        $model->price = $param['price'];
        $model->stock = $param['stock'];
//        $model->number = $param['number'];
//        $model->maxbuy = $param['maxbuy'];
        $model->created_by = $param['created_by'];
        $model->category_id = $param['category_id'];
        $model->displayorder = $param['displayorder'];
        $model->program_id = $param['program_id'];
        $model->organization_id = $param['organization_id'];
        $model->save();
        return $model->id;
    }
    
    //修改餐饮商品数据
    public static function editCateringGoods($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('create_account')->with('category')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>