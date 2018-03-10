<?php
/**
 * program_admin表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoreUserLog extends Model{
    use SoftDeletes;
    protected $table = 'store_user_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //简易型查询单条数据关联查询
    public static function getOne($where)
    {
        return self::where($where)->first();
    }
    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('organization')->with('account_info')->with('account_roles');
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //冻结账号
    public static function editOrganizationBatch($where,$param){
        $model =  self::where($where)->get();
        foreach ($model as $k=>$v){
            foreach($param as $key=>$val){
                $v->$key=$val;
            }
            $v->save();
        }
    }

    //修改账号
    public static function editAccount($where,$param){
        $model = self::where($where)->first();
        foreach($param as $key=>$val){
            $model->$key=$val;
        }
        $model->save();
    }

    //查询获取账户的模块和节点列表
    public static function get_module_node($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('account_node')->with('account_info');
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }


    //登录时通过输入的用户名或手机号查询用户
    public static function getOneForLogin($username){
        return self::with('account_info')->with('account_roles')->with('organization')->where('account',$username)->orWhere('mobile',$username)->first();
    }
    //根据条件查询一条数据
    public static function getOneAccount($where){
        return self::with('account_info')->with('account_roles')->with('organization')->where($where)->first();
    }
    //添加用户
    public static function addAccount($param){
        $model = new Account();
        $model->organization_id = $param['organization_id'];//组织ID
        $model->parent_id = $param['parent_id'];//上级用户ID
        $model->parent_tree = $param['parent_tree'];//组织树
        $model->deepth = $param['deepth'];//用户在该组织里的深度
        $model->account = $param['account'];//登录账号（零壹平台,自动生成）
        $model->password = $param['password'];//登录密码（MD5默认32位长度）
        $model->mobile = $param['mobile'];//管理员绑定的手机号码
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
    //获取分页数据
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>