<?php
namespace App\Libraries\ZeroneLog;
use App\Models\ToolingErrorLog;
use App\Models\ToolingLoginLog;
use App\Models\ToolingOperationLog;
class ToolingLog{
    //记录操作日志
    public static function setOperationLog($account_id,$route_name,$info){
        $operation_log = new ToolingOperationLog();
        $operation_log->account_id = $account_id;
        $operation_log->route_name = $route_name;
        $operation_log->operation_info = $info;
        $operation_log->save();
    }
    //记录登录日志
    public static function setLoginLog($account_id,$ip,$addr){
        $loginlog = new ToolingLoginLog();
        $loginlog->account_id = $account_id;
        $loginlog->ip = $ip;
        $loginlog->ip_position = $addr;
        $loginlog->save();
        $id = $loginlog->id;
        if(empty($id)){
            return false;
        }else{
            return true;
        }
    }
    //错误次数记录
    public static function setErrorLog($ip){
        $error = new ToolingErrorLog();
        $error_log = $error->where('ip',$ip)->first();//获取该IP的错误记录

        if(empty($error_log)){//没有错误记录，插入错误记录，有错误记录，更新错误记录
            $error->ip = $ip;
            $error->error_time = 1;
            $error->save();
        }else{
            $error->where('ip',$ip)->increment('error_time');
        }
    }
    //清除错误记录
    public static function clearErrorLog($ip){
        $error = new ToolingErrorLog();
        $error->where('ip',$ip)->update(['error_time'=>0]);
    }
}
?>