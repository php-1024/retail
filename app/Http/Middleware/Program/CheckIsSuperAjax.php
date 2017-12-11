<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProgramCheckIsSuperAjax{
    public function handle($request,Closure $next){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['admin_is_super']!=1){
            return response()->json(['data' => '您没有该功能的权限！', 'status' => '0']);
        }else{
            return $next($request);
        }
    }
}
?>