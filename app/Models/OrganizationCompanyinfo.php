<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationCompanyinfo extends Model{
    use SoftDeletes;
    protected $table = 'organization_companyinfo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和organization表一对一的关系
    public function Organization(){
        return $this->belongsto('App\Models\Organization', 'organization_id','id');//by tang, hasone -->belongsto
    }

    //添加数据
    public static function addOrganizationCompanyinfo($param){
        $program = new OrganizationCompanyinfo();//实例化程序模型
        $program->organization_id = $param['organization_id'];//组织id
        $program->company_owner = $param['company_owner'];//商户负责人姓名
        $program->company_owner_idcard = $param['company_owner_idcard'];//商户负责人身份证
        $program->company_owner_mobile = $param['company_owner_mobile'];//商户负责人手机号
        $program->save();
        return $program->id;
    }
    //修改数据
    public static function editOrganizationCompanyinfo($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
}
?>