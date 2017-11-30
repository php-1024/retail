<?php
/**
 * 系统管理
 */
namespace App\Http\Controllers\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Routing\Route;
class SystemController extends Controller{
    public function dashboard(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route = new Route();

        dump($route->getName());
        return view('Program/System/dashboard',['admin_data'=>$admin_data]);
    }

    public function quit(){
        Session::put('zerone_program_account_id','');
        return redirect('program/login');
    }
}
?>