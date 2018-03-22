<?php
/**
 * program_operation_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ToolingOperationLog extends Model{
    use SoftDeletes;
    protected $table = 'tooling_operation_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //关联程序管理工具账户表
    public function accounts(){
        return $this->belongsTo('App\Models\ToolingAccount', 'account_id');
    }

    //查询获取列表
    public static function getList($where,$limit=0,$orderby,$sort='DESC'){
        $model = self::with('accounts');
        if(!empty($limit)){
            $model = $model->limit($limit);
        }
        return $model->where($where)->orderBy($orderby,$sort)->get();
    }

    //添加操作日志
    public static function addOperationLog($account_id,$route_name,$info){
        $operation_log = new ToolingOperationLog();
        $operation_log->account_id = $account_id;
        $operation_log->route_name = $route_name;
        $operation_log->operation_info = $info;
        $operation_log->save();
    }

    //获取不联表的分页数据
    public static function getPaginate($where,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::where($where);
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }

    //获取联表的分页数据
    public static function getUnionPaginate($account,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::join('tooling_account',function($join){
            $join->on('tooling_operation_log.account_id','=','tooling_account.id');
        })->select('tooling_account.account','tooling_operation_log.*');
        if(!empty($account)){
            $model =$model->where('account','like','%'.$account.'%');
        }
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('tooling_operation_log.created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>