<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SystemController extends Controller{
    public function dashboard(Request $request){
        date_default_timezone_set('Asia/ShangHai');
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        dump(date('Y-m-d H:i:s'));
        return view('Program/System/dashboard',['admin_data'=>$admin_data]);
    }
}
?>