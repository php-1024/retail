<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SystemController extends Controller{
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        dump($admin_data);
        return view('Program/System/dashboard',$admin_data);
    }
}
?>