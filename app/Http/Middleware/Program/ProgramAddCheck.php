<?php
/**
 * 检测修改密码数据中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramProgramAddCheck{
    public function handle($request,Closure $next){
        if(empty($request->input('program_name'))){
            return response()->json(['data' => '请输入程序名称', 'status' => '0']);
        }
        if(empty($request->input('module_node_ids'))){
            return response()->json(['data' => '请勾选功能模块', 'status' => '0']);
        }
        return $next($request);
    }
}
?>