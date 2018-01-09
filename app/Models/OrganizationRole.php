<?php
/**
 * module_node表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrganizationRole extends Model{
    use SoftDeletes;
    protected $table = 'organization_role';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者account表多对一的关系
    public function create_account(){
        return $this->belongsTo('App\Models\Account', 'created_by');
    }

    //和功能节点关系表，多对多
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node','role_node','role_id','node_id');
    }

    //添加组织角色
    public static function addRole($param){
        $model = new OrganizationRole();
        $model->program_id = $param['program_id'];
        $model->organization_id = $param['organization_id'];
        $model->created_by = $param['created_by'];
        $model->role_name = $param['role_name'];
        $model->save();
        return $model->id;
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


    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('create_account')->with('nodes')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>