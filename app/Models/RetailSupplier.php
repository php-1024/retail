<?php
/**
 * retail_supplier表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RetailSupplier extends Model{
    use SoftDeletes;
    protected $table = 'retail_supplier';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和组织表Organization表多对一的关系
    public function Organization(){
        return $this->belongsto('App\Models\Organization','retail_id');
    }

    //和组织表RetailPurchaseOrder表多对一的关系
    public function RetailPurchaseOrder(){
        return $this->hasMany('App\Models\RetailPurchaseOrder','company_id');
    }

    //搜索供应商信息
    public static function SearchCompany($retail_id,$company_id,$company_name,$contactmobile){
        $model = new RetailSupplier();
        $model = $model->where(['retail_id'=>$retail_id]);
        if(!empty($company_id)){
            $model = $model->where(['id'=>$company_id]);
        }
        if(!empty($company_name)){
            $model = $model->where('company_name','like','%'.$company_name.'%');
        }
        if(!empty($contactmobile)){
            $model = $model->where('contactmobile','like','%'.$contactmobile.'%');
        }
        return $model->first();
    }

    //获取单挑数据
    public static function getOne($where){
        return self::where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new RetailSupplier();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加组织供应商
    public static function addSupplier($param){
        $model = new RetailSupplier();
        $model->company_name = $param['company_name'];
        $model->contactname = $param['contactname'];
        $model->contactmobile = $param['contactmobile'];
        $model->displayorder = $param['displayorder'];
        $model->fansmanage_id = $param['fansmanage_id'];
        $model->retail_id = $param['retail_id'];
        $model->save();
        return $model->id;
    }
    //修改数据
    public static function editSupplier($where,$param){
        if($model = self::where($where)->first()){
            foreach($param as $key=>$val){
                $model->$key=$val;
            }
            $model->save();
        }
    }

    //获取分页列表
    public static function getPaginage($where,$company_name,$paginate,$orderby,$sort='DESC'){
        $model = self::with('Organization');
        if(!empty($company_name)){
            $model = $model->where('company_name','like','%'.$company_name.'%');
        }
        return $model->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //查询出模型，再删除模型 一定要查询到才能删除
    public static function select_delete($id){
        $model = Self::find($id);
        return $model->forceDelete();
    }
}
?>