<?php
/**
 * organization_category表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrganizationCategory extends Model{
    use SoftDeletes;
    protected $table = 'organization_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //和创建者account表多对一的关系
    public function create_account(){
        return $this->belongsto('App\Models\Account','created_by');
    }

    //和功能节点关系表，多对多
    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node','role_node','role_id','node_id');
    }

    //获取单条信息
    public static function getOne($where){
        return self::with('nodes')->where($where)->first();
    }

    //获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = new OrganizationCategory();
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加组织栏目分类
    public static function addCategory($param){
        $model = new OrganizationCategory();
        $model->program_id = $param['program_id'];
        $model->organization_id = $param['organization_id'];
        $model->created_by = $param['created_by'];
        $model->category_sort = $param['category_sort'];
        $model->category_name = $param['category_name'];
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

    //获取操作记录时根据account_id查询角色名
    public static function getLogsRoleName($account_id){
        $row = self::whereIn('id',function($query) use ($account_id){
            $query->from('role_account')->where('account_id',$account_id)->select('role_id');
        })->first();
        if(empty($row)){
            return '系统管理员';
        }else{
            return $row->role_name;
        }
    }

    //获取分页列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('create_account')->with('nodes')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>