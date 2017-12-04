<?php
/**
 * 检测修改密码数据中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;

class ProgramNodeAddCheck{
    public function handle($request,Closure $next){
        dump($this->input());
        exit();
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