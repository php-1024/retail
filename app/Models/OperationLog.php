<?php
/**
 * program_operation_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OperationLog extends Model{
    use SoftDeletes;
    protected $table = 'operation_log';
    protected $primaryKey = 'id';//主键ID
    public $timestamps = true;//是否使用时间戳
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //关联程序管理工具账户表
    public function accounts(){
        return $this->belongsTo('App\Models\Account', 'account_id');
    }
    //和个人信息表一对一的关系
    public function account_info(){
        return $this->belongsTo('App\Models\AccountInfo', 'account_id','account_id');
    }
    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('accounts');
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }
    //根据时间戳操作用户分页查询获取列表
    public static function getPaginate($where,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::with('account_info')->where($where);
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }

    //添加登录日志
    public static function addOperationLog($program_id,$organization_id,$account_id,$route_name,$info){
        $operation_log = new OperationLog();
        $operation_log->program_id = $program_id;
        $operation_log->organization_id = $organization_id;
        $operation_log->account_id = $account_id;
        $operation_log->route_name = $route_name;
        $operation_log->operation_info = $info;
        $operation_log->save();
    }
    //获取联表的分页数据
    public static function getUnionPaginate($account,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::join('account',function($join){
            $join->on('operation_log.account_id','account.id');
        })->select('account.account','operation_log.*');
        if(!empty($account)){
            $model =$model->where('account','like','%'.$account.'%');
        }
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('operation_log.created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
    //获取联表的分页数据
    public static function getAgentPaginate($where,$paginate,$orderby,$sort='DESC'){
        $model = self::join('account',function($join){
            $join->on('operation_log.account_id','account.id');
        })->where($where)->select('account.account','operation_log.*');

        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>