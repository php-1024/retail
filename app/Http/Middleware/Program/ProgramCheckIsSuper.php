<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProgramCheckIsSuper{
    public function handle($request,Closure $next){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['admin_is_super']!=1){
            return redirect('program');
        }else{
            return $next($request);
        }
    }
}
?>