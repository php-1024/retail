<?php
/**
 * organization_simpleinfo表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationSimpleinfo extends Model{
    use SoftDeletes;
    protected $table = 'organization_simpleinfo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和organization表一对一的关系
    public function organization(){
        return $this->belongsto('App\Models\Organization', 'organization_id');//by tang,hasone-->belongsto
    }

    //添加数据
    public static function addOrganizationSimpleinfo($param){
        $program = new OrganizationSimpleinfo();//实例化程序模型
        $program->organization_id = $param['organization_id'];//组织id
        $program->simple_owner = $param['simple_owner'];//分店负责人姓名
        $program->simple_owner_idcard = $param['simple_owner_idcard'];//分店负责人身份证
        $program->simple_owner_mobile = $param['simple_owner_mobile'];//分店负责人手机号
        if(!empty($param['simple_address'])){
            $program->simple_address = $param['simple_address'];//详细地址
        }
        if(!empty($param['lng'])){
            $program->lng = $param['lng'];//百度经度
        }
        if(!empty($param['lat'])){
            $program->lat = $param['lat'];//百度纬度
        }
        $program->save();
        return $program->id;
    }

    //查询数据是否存在（仅仅查询ID增加数据查询速度）
    public static function checkRowExists($where){
        $row = self::getPluck($where,'id')->toArray();
        if(empty($row)){
            return false;
        }else{
            return true;
        }
    }

    //修改数据
    public static function editOrganizationSimpleinfo($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }
}
?>