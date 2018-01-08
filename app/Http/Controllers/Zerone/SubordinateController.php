<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class SubordinateController extends Controller{
    //添加下级人员
    public function subordinate_add(Request $request){
        echo "这里是添加下级人员";
    }

    //添加下级人员数据提交
    public function subordinate_add_check(Request $request){
        echo "这里是添加下级人员数据提交";
    }

    //下级人员列表
    public function subordinate_list(Request $request){
        echo "这里是下级人员列表";
    }

    //编辑下级人员
    public function subordinate_edit(Request $request){
        echo "这里是编辑下级人员";
    }

    //编辑下级人员数据提交
    public function subordinate_edit_check(Request $request){
        echo "这里是编辑下级人员数据提交";
    }

    //冻结下级人员
    public function subordinate_lock(Request $request){
        echo "这里是冻结下级人员";
    }

    //删除下级人员
    public function subordinate_delete(Request $request){
        echo "这里是删除下级人员";
    }

    //下级人员结构
    public function subordinate_structure(Request $request){
        echo "这里是下级人员结构";
    }
}
?>