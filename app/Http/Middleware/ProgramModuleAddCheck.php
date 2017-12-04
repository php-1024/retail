<?php
/**
 * 检测修改密码数据中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramModuleAddCheck{
    public function handle($request,Closure $next){

        if(empty($request->input('module_name'))){
            return response()->json(['data' => '请输入模块名称', 'status' => '0']);
        }
        if(empty($request->input('route_name'))){
            return response()->json(['data' => '请选择该模块的功能节点到右边选框', 'status' => '0']);
        }
        return $next($request);
    }
}
?>