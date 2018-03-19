<?php
/**
 * warzone_province(战区关系表模型)表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrganizationAssetsallocation extends Model{
    use SoftDeletes;
    protected $table = 'organization_assetsallocation';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和组织表一对一的关系
    public function fr_organization_id(){
        return $this->belongsTo('App\Models\Organization', 'fr_organization_id','id');
    }

    //和组织表一对一的关系
    public function to_organization_id(){
        return $this->belongsTo('App\Models\Organization', 'to_organization_id','id');
    }

    //和套餐表一对一的关系
    public function package(){
        return $this->belongsTo('App\Models\Package','package_id','id');
    }

    //获取单条信息
    public static function getOne($where){
        return self::where($where)->first();
    }
    //添加数据
    public static function addOrganizationAssetsallocation($param){
        $program = new OrganizationAssetsallocation();//实例化程序模型
        $program->operator_id = $param['operator_id'];//操作人id
        $program->fr_organization_id = $param['fr_organization_id '];//划出组织
        $program->to_organization_id = $param['to_organization_id'];//划入组织
        $program->program_id = $param['program_id'];//程序id
        $program->status = $param['status'];//操作状态
        $program->number = $param['number'];//操作数量
        $program->save();
    }
    //获取分页数据
    public static function getPaginage($where,$orWhere,$paginate,$orderby,$sort='DESC'){
        return self::with('fr_organization_id')->with('to_organization_id')->with('package')->Where($where)->orWhere($orWhere)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>