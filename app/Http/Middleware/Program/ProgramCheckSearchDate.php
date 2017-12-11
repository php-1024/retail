<?php
/**
 * 检测是否登陆的中间件
 */
namespace App\Http\Middleware\Program;
use Closure;
use Session;
use Illuminate\Support\Facades\Redis;

class ProgramCheckSearchDate{
    public function handle($request,Closure $next){
        $time_st = $request->input('time_st');
        $time_nd = $request->input('time_nd');
        $time_st_format = strtotime($time_st);
        $time_nd_format = strtotime($time_nd);

        if((empty($time_st) && !empty($time_nd)) || (!empty($time_st) && empty($time_nd))){
            return response()->json(['data' => '错误的日期格式！', 'status' => '0']);
        }
        if(!empty($time_st) && !empty($time_nd) && $time_nd_format<$time_st_format){
            return response()->json(['data' => '错误的日期格式！', 'status' => '0']);
        }
        return $next($request);
    }
}
?>