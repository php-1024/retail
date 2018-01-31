<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssetsOperation extends Model{
    use SoftDeletes;
    protected $table = 'assets_operation';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和组织表一对一的关系
    public function organization(){
        return $this->hasOne('App\Models\Organization', 'id','organization_id');
    }

    //和套餐表一对一的关系
    public function package(){
        return $this->hasOne('App\Models\Package', 'id');
    }

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }
    //添加数据
    public static function addAssetsOperation($account_id,$organization_id,$package_id,$program_id,$status,$number){
        $program = new AssetsOperation();//实例化程序模型
        $program->account_id = $account_id;//操作人id
        $program->organization_id = $organization_id;//程序名称
        $program->package_id = $package_id;//套餐id
        $program->program_id = $program_id;//程序id
        $program->status = $status;//操作状态
        $program->number = $number;//操作数量
        $program->save();
    }
    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('organization','package')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>