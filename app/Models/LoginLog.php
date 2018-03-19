<?php
/**
 * program_login_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LoginLog extends Model{
    use SoftDeletes;
    protected $table = 'login_log';
    protected $primaryKey = 'id';//主键ID
    public $timestamps = true;//是否使用时间戳
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //关联程序管理工具账户表
    public function accounts(){
        return $this->belongsTo('App\Models\Account', 'account_id');
    }

    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('accounts');
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }
    //分页查询获取列表
    public static function getPaginage($where,$paginate,$orderby,$sort='DESC'){
        return self::with('accounts')->where($where)->orderBy($orderby,$sort)->paginate($paginate);
    }

    //根据时间戳分页查询获取列表
    public static function getPaginate($where,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::with('accounts')->where($where);
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }

    //添加登录日志
    public static function addLoginLog($account_id,$program_id,$organization_id,$ip,$addr){
        $loginlog = new LoginLog();//新建模型
        $loginlog->account_id = $account_id;//用户账号ID
        $loginlog->ip = $ip;//登录IP
        $loginlog->ip_position = $addr;//登录地址
        $loginlog->program_id = $program_id; //登录哪套程序
        $loginlog->organization_id = $organization_id;//哪个组织的账号登录
        $loginlog->save();//保存数据
        $id = $loginlog->id;//获取插入ID
        if(empty($id)){
            return false;
        }else{
            return true;
        }
    }
    //获取联表分页数据
    public static function getUnionPaginate($account,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::join('account',function($join){
            $join->on('login_log.account_id','=','account.id');
        })->select('account.account','login_log.*');
        if(!empty($account)){
            $model =$model->where('account','like','%'.$account.'%');
        }
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('login_log.created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取联表分页数据
    public static function getAgentPaginate($where,$paginate,$orderby,$sort='DESC'){
        $model = self::join('account',function($join){
            $join->on('login_log.account_id','=','account.id');
        })->where($where)->select('account.account','login_log.*');
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>