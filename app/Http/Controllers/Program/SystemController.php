<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class SystemController extends Controller{
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        return view('Program/System/dashboard',['admin_data'=>$admin_data]);
    }

    public function quit(){
        Session::put('zerone_program_account_id','');
        return redirect('Program/login');
    }
}
?>