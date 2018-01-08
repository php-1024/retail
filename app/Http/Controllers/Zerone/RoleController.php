<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller{
    //添加权限角色
    public function role_add(Request $request){
        echo "这是添加权限角色";
    }

    //提交添加权限假设数据
    public function role_add_check(Request $request){
        echo "这里是添加权限角色数据提交";
    }

    //权限角色列表
    public function role_list(Request $request){
        echo "这里是权限角色列表";
    }

    //编辑权限角色
    public function role_edit(Request $request){
        echo "这里是编辑权限角色";
    }

    //编辑权限角色提交
    public function role_edit_check(Request $request){
        echo "这里是编辑权限角色数据提交";
    }

    //删除权限角色
    public function role_delete(Request $request){
        echo "这是是删除权限角色检测";
    }
}