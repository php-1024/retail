<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationBranchinfo extends Model{
    use SoftDeletes;
    protected $table = 'organization_branchinfo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和organization表一对一的关系
    public function organization(){
        return $this->belongsto('App\Models\Organization', 'organization_id');//by tang,hasone-->belongsto
    }

    //添加数据
    public static function addOrganizationBranchinfo($param){
        $program = new OrganizationBranchinfo();//实例化程序模型
        $program->organization_id = $param['organization_id'];//组织id
        $program->branch_owner = $param['branch_owner'];//分店负责人姓名
        $program->branch_owner_idcard = $param['branch_owner_idcard'];//分店负责人身份证
        $program->branch_owner_mobile = $param['branch_owner_mobile'];//分店负责人手机号
        $program->type = $param['type'];//0为总店 1为分店
        $program->save();
        return $program->id;
    }
    //修改数据
    public static function editOrganizationBranchinfo($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
}
?>