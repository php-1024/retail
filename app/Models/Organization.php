<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Organization extends Model{
    use SoftDeletes;
    protected $table = 'organization';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和account表一对多的关系
    public function account(){
        return $this->hasMany('App\Models\Account', 'organization_id');
    }

    //添加数据
    public static function addProgram($param){
        $organization = new Organization();//实例化程序模型

        $organization->organization_name = $param['organization_name'];//组织名称
        $organization->parent_id = $param['parent_id'];//多级组织的关系
        $organization->parent_tree = $param['parent_tree'];//上级程序
        $organization->program_id = $param['program_id'];//组织关系树
        $organization->type = $param['type'];//类型 2为服务商
        $organization->status = $param['status'];//状态 1-正常 0-冻结
        $organization->save();
        return $organization->id;
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
    //获取单行数据的其中一列
    public static function getPluck($where,$pluck){
        return self::where($where)->pluck($pluck);
    }
}
?>