<?php
/**
 * 检测添加账号数据中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramAccountEditCheck {
    public function handle($request,Closure $next){
        if(empty($request->input('id'))){
            return response()->json(['data' => '数据传输错误', 'status' => '0']);
        }
        if(empty($request->input('node_name'))){
            return response()->json(['data' => '请输入节点名称', 'status' => '0']);
        }
        if(empty($request->input('route_name'))){
            return response()->json(['data' => '请输入路由名称', 'status' => '0']);
        }
        return $next($request);
    }
}
?>