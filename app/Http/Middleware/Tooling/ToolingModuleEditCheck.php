<?php
/**
 * 检测修改密码数据中间件
 */
namespace App\Http\Middleware\Tooling;
use Closure;
use Session;

class ToolingModuleEditCheck{
    public function handle($request,Closure $next){
        if(empty($request->input('id'))){
            return response()->json(['data' => '数据传输错误', 'status' => '0']);
        }
        if(empty($request->input('module_name'))){
            return response()->json(['data' => '请输入模块名称', 'status' => '0']);
        }
        if(empty($request->input('nodes'))){
            return response()->json(['data' => '请选择该模块的功能节点到右边选框', 'status' => '0']);
        }
        return $next($request);
    }
}
?>