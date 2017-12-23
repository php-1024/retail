<?php
/**
 * program_operation_log表的模型
 *
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ToolingOperationLog extends Model{
    protected $table = 'tooling_operation_log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $dateFormat = 'U';//设置保存的created_at updated_at为时间戳格式

    //关联程序管理工具账户表
    public function accounts(){
        return $this->belongsTo('App\Models\ToolingAccount', 'account_id');
    }

    //查询获取列表
    public static function getList($where,$limit,$orderby,$sort='DESC'){
        return self::with('accounts')->where($where)->where('is_delete','0')->limit($limit)->orderBy($orderby,$sort)->get();
    }

    //添加操作日志
    public static function addOperationLog($account_id,$route_name,$info){
        $operation_log = new ToolingOperationLog();
        $operation_log->account_id = $account_id;
        $operation_log->route_name = $route_name;
        $operation_log->operation_info = $info;
        $operation_log->save();
    }

    //获取分页数据
    public static function getPaginage($account,$time_st_format,$time_nd_format,$paginate,$orderby,$sort='DESC'){
        $model = self::where('is_delete','0');
        if(!empty($account)){
            $model=$model->with(['accounts'=>function($query) use ($account){
                $query->where('account','like','%'.$account.'%');
            }]);
        }
        if(!empty($time_st_format) && !empty($time_nd_format)){
            $model = $model->whereBetween('created_at',[$time_st_format,$time_nd_format]);
        }
        return $model->orderBy($orderby,$sort)->paginate($paginate);
    }
}
?>