<?php
/**
 * catering_category表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CateringCategory extends Model{
    use SoftDeletes;
    protected $table = 'catering_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者account表多对一的关系
    public function create_account(){
        return $this->belongsto('App\Models\Account','created_by');
    }

    //和组织表Organization表一对一的关系
    public function Organization(){
        return $this->belongsto('App\Models\Organization','branch_id','id');
    }

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new CateringCategory();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加组织栏目分类
    public static function addCategory($param){
        $model = new CateringCategory();
        $model->name = $param['name'];
        $model->created_by = $param['created_by'];
        $model->displayorder = $param['displayorder'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->restaurant_id = $param['restaurant_id'];
        $model->save();
        return $model->id;
    }
    //修改数据
    public static function editCategory($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$category_name,$paginate,$orderby,$sort='DESC'){
        $model = self::with('Organization');
        if(!empty($category_name)){
            $model = $model->where('name','like','%'.$category_name.'%');
        }
        return $model->with('create_account')->with('Organization')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //查询出模型，再删除模型 一定要查询到才能删除
    public static function select_delete($id){
        $model = Self::find($id);
        return $model->delete();
    }
}
?>