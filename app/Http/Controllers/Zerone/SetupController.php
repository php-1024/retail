<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Models\Module;
Use App\Models\OrganizationRole;
Use App\Models\RoleNode;
Use App\Models\OperationLog;

use Session;

class SetupController extends Controller{
    //参数设置展示
    public function setup_show(Request $request){
        echo "这里参数设置展示页面！";
    }
    //参数设置编辑
    public function setup_edit(Request $request){
        echo "这里是参数设置编辑页面";
    }
}