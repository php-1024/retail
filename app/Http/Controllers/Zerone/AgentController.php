<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\AccountNode;
use App\Models\Assets;
use App\Models\AssetsOperation;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationAgentinfo;
use App\Models\Package;
use App\Models\WarzoneAgent;
use Illuminate\Http\Request;
use App\Models\AgentApply;
use App\Models\Warzone;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Session;
class AgentController extends Controller{

    //服务商审核列表
    public function agent_examinelist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $agent_name = $request->input('agent_name');
        $agent_owner_mobile = $request->input('agent_owner_mobile');
        $search_data = ['agent_name'=>$agent_name,'agent_owner_mobile'=>$agent_owner_mobile];
        $where = [];
        if(!empty($agent_name)){
            $where[] = ['agent_name','like','%'.$agent_name.'%'];
        }
        if(!empty($agent_owner_mobile)){
            $where[] = ['agent_owner_mobile',$agent_owner_mobile];
        }

        $list = agentApply::getPaginage($where,'15','id');
        return view('Zerone/Agent/agent_examinelist',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商审核ajaxshow显示页面
    public function agent_examine(Request $request){
        $id = $request->input('id');//服务商id
        $status= $request->input('status');//是否通过值 1为通过 -1为不通过
        $info =  agentApply::getOne([['id',$id]]);//获取该ID的信息
        return view('Zerone/Agent/agent_examine',['info'=>$info,'status'=>$status]);
    }
    //服务商审核数据提交
    public function agent_examine_check(Request $request){
        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//是否通过值 1为通过 -1为不通过
        $agentlist = agentApply::getOne([['id',$id]]);//查询申请服务商信息
        $program_id = 2;
        if($status == -1 ){
            DB::beginTransaction();
            try{
                AgentApply::editAgentApply([['id',$id]],['status'=>$status]);//拒绝通过
                //添加操作日志
                OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'拒绝了服务商：'.$agentlist['agent_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '拒绝失败', 'status' => '0']);
            }
            return response()->json(['data' => '拒绝成功', 'status' => '1']);
        }elseif($status == 1){
            DB::beginTransaction();
            try{
                AgentApply::editAgentApply([['id',$id]],['status'=>$status]);//申请通过

                $orgparent_tree = '0'.',';//服务商组织树
                //添加服务商
                $orgData = [
                    'organization_name'=>$agentlist['agent_name'],
                    'parent_id'        =>0,
                    'parent_tree'      =>$orgparent_tree,
                    'program_id'       =>2,
                    'type'             =>2,
                    'status'           =>1
                ];
                $organization_id = Organization::addOrganization($orgData); //返回值为商户的id

                $agentdata = [
                    'organization_id'=>$organization_id,
                    'zone_id'        =>$agentlist['zone_id']
                ];
                WarzoneAgent::addWarzoneAgent($agentdata);//战区关联服务商

                $user = Account::max('account');
                $account  = $user+1;//用户账号
                $parent_id = $admin_data['id'];//上级ID是当前用户ID
                $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
                $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度

                $password = $agentlist['agent_password'];//用户密码
                $accdata = [
                    'parent_id'      =>$parent_id,
                    'parent_tree'    =>$parent_tree,
                    'deepth'         =>$deepth,
                    'mobile'         =>$agentlist['agent_owner_mobile'],
                    'password'       =>$password,
                    'organization_id'=>$organization_id,
                    'account'        =>$account
                ];
                $account_id = Account::addAccount($accdata);//添加账号返回id

                $realname = $agentlist['agent_owner'];//负责人姓名
                $idcard = $agentlist['agent_owner_idcard'];//负责人身份证号
                $acinfodata = [
                    'account_id'=>$account_id,
                    'realname'  =>$realname,
                    'idcard'    =>$idcard
                ];
                AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

                $orgagentinfo = [
                    'agent_id'          =>$organization_id,
                    'agent_owner'       =>$realname,
                    'agent_owner_idcard'=>$idcard,
                    'agent_owner_mobile'=>$agentlist['agent_owner_mobile']
                ];
                OrganizationAgentinfo::addOrganizationAgentinfo($orgagentinfo);  //添加到服务商组织信息表

                $module_node_list = Module::getListProgram($program_id, [], 0, 'id');//获取当前系统的所有节点
                foreach($module_node_list as $key=>$val){
                    foreach($val->program_nodes as $k=>$v) {
                        AccountNode::addAccountNode(['account_id' => $account_id, 'node_id' => $v['id']]);
                    }
                }

                //添加操作日志
                OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'服务商审核通过：'.$agentlist['agent_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '审核失败', 'status' => '0']);
            }
            return response()->json(['data' => '申请通过', 'status' => '1']);
        }
    }

    //添加服务商
    public function agent_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $warzone_list = Warzone::all();
        return view('Zerone/Agent/agent_add',['warzone_list'=>$warzone_list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //提交服务商数据
    public function agent_add_check(Request $request){
        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_name = $request->input('organization_name');//服务商名称
        $where = [['organization_name',$organization_name]];
        if(Organization::checkRowExists($where)){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }

        $zone_id = $request->input('zone_id');//战区id
        $parent_id = $admin_data['id'];//上级ID是当前用户ID
        $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
        $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度
        $mobile = $request->input('mobile');//手机号码
        $password = $request->input('agent_password');//用户密码
        $key = config("app.agent_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $program_id = 2;
        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$organization_name,'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'program_id'=>$program_id,'type'=>2,'status'=>1];
            $organization_id = Organization::addOrganization($listdata); //返回值为商户的id

            $agentdata = ['organization_id'=>$organization_id,'zone_id'=>$zone_id];
            Warzoneagent::addWarzoneagent($agentdata);//战区关联服务商
            $user = Account::max('account');
            $account  = $user+1;//用户账号
            $accdata = ['parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'deepth'=>$deepth,'mobile'=>$mobile,'password'=>$encryptPwd,'organization_id'=>$organization_id,'account'=>$account];
            $account_id = Account::addAccount($accdata);//添加账号返回id
            $realname = $request->input('realname');//负责人姓名
            $idcard = $request->input('idcard');//负责人身份证号
            $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
            AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

            $module_node_list = Module::getListProgram($program_id, [], 0, 'id');//获取当前系统的所有节点
            foreach($module_node_list as $key=>$val){
                foreach($val->program_nodes as $k=>$v) {
                    AccountNode::addAccountNode(['account_id' => $account_id, 'node_id' => $v['id']]);
                }
            }
            $orgagentinfo = ['agent_id'=>$organization_id, 'agent_owner'=>$realname, 'agent_owner_idcard'=>$idcard, 'agent_owner_mobile'=>$mobile];
            OrganizationAgentinfo::addOrganizationAgentinfo($orgagentinfo);  //添加到服务商组织信息表
            //添加操作日志
            OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'添加了服务商：'.$organization_name);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '注册失败', 'status' => '0']);
        }
        return response()->json(['data' => '注册成功', 'status' => '1']);

    }


    //服务商列表
    public function agent_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $organization_name = $request->input('organization_name');
        $search_data = ['organization_name'=>$organization_name];
        $where = [['type','2']];
        if(!empty($organization_name)){
            $where[] = ['organization_name','like','%'.$organization_name.'%'];
        }
        $listorg = Organization::getPaginage($where,'5','id');
        foreach ($listorg as $k=>$v){
            $zone_id = $v['warzoneAgent']['zone_id'];
            $listorg[$k]['zone_name'] = Warzone::where([['id',$zone_id]])->pluck('zone_name')->first();
        }
        return view('Zerone/Agent/agent_list',['search_data'=>$search_data,'listorg'=>$listorg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商编辑ajaxshow显示页面
    public function agent_list_edit(Request $request){

        $id = $request->input('id');//服务商id
        $listorg = Organization::getOneagent([['id',$id]]);
        $warzone = Warzone::all();
        return view('Zerone/Agent/agent_list_edit',['listorg'=>$listorg,'warzone'=>$warzone]);
    }
    //服务商编辑功能提交
    public function agent_list_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $zone_id = $request->input('zone_id');//战区id
        $organization_name = $request->input('organization_name');//服务商名称
        $realname = $request->input('realname');//用户名字
        $idcard = $request->input('idcard');//用户身份证号
        $mobile = $request->input('mobile');//用户手机号
        $password = $request->input('password');//登入密码

        $where = [['organization_name',$organization_name],['id','<>',$id]];

        $name = Organization::checkRowExists($where);

        if($name == 'true'){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }

        DB::beginTransaction();
        try{
            $list = Organization::getOneagent(['id'=>$id]);
            $acc = Account::getOne(['organization_id'=>$id,'parent_id'=>'1']);
            $account_id = $acc['id'];
            if($list['organization_name']!=$organization_name){
                Organization::editOrganization([['id',$id]], ['organization_name'=>$organization_name]);//修改服务商表服务商名称
            }
            if($list['mobile']!=$mobile){
                OrganizationAgentinfo::editOrganizationAgentinfo([['agent_id',$id]], ['agent_owner_mobile'=>$mobile]);//修改服务商表服务商手机号码
                Account::editAccount(['organization_id'=>$id],['mobile'=>$mobile]);//修改用户管理员信息表 手机号
            }

            if($list['organizationagentinfo']['agent_owner'] != $realname){
                OrganizationAgentinfo::editOrganizationAgentinfo([['agent_id',$id]],['agent_owner'=>$realname]);//修改服务商用户信息表 用户姓名
                AccountInfo::editAccountInfo([['account_id',$account_id]],['realname'=>$realname]);//修改用户管理员信息表 用户名
            }
            if(!empty($password)){
                $key = config("app.zerone_encrypt_key");//获取加密盐
                $encrypted = md5($password);//加密密码第一重
                $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
                Account::editAccount([['organization_id',$id],['parent_id','1']],['password'=>$encryptPwd]);//修改管理员表登入密码
            }
            if($acc['idcard'] != $idcard){
                AccountInfo::editAccountInfo([['account_id',$account_id]],['idcard'=>$idcard]);//修改用户管理员信息表 身份证号
                OrganizationAgentinfo::editOrganizationAgentinfo([['agent_id',$id]],['agent_owner_idcard'=>$idcard]);//修改服务商信息表 身份证号
            }
            $waprlist = Warzoneagent::getOne([['organization_id',$id]]);
            if($waprlist['zone_id'] != $zone_id){
                WarzoneAgent::editWarzoneAgent([['organization_id',$id]],['zone_id'=>$zone_id]);//修改战区关联表 战区id
            }

            //添加操作日志
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了服务商：'.$list['organization_name']);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改失败', 'status' => '0']);
        }
        return response()->json(['data' => '修改成功', 'status' => '1']);
    }

    //服务商冻结ajaxshow显示页面
    public function agent_list_frozen(Request $request){
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//冻结状态
        $list = Organization::getOneagent([['id',$id]]);//服务商信息
        return view('Zerone/agent/agent_list_frozen',['id'=>$id,'list'=>$list,'status'=>$status]);
    }
    //服务商冻结功能提交
    public function agent_list_frozen_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//服务商id
        $list = Organization::getOneagent([['id',$id]]);
            DB::beginTransaction();
            try{
                if($status == '1'){
                    Organization::editOrganization([['id',$id]],['status'=>'0']);
                    Account::editOrganizationBatch([['organization_id',$id]],['status'=>'0']);
                    //添加操作日志
                    OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'冻结了服务商：'.$list['organization_name']);//保存操作记录
                }elseif($status == '0'){
                        Organization::editOrganization([['id',$id]],['status'=>'1']);
                        Account::editOrganizationBatch([['organization_id',$id]],['status'=>'1']);
                        //添加操作日志
                        OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'解冻了服务商：'.$list['organization_name']);//保存操作记录
                }
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '操作失败', 'status' => '0']);
            }
            return response()->json(['data' => '操作成功', 'status' => '1']);
    }
    //服务商删除ajaxshow显示页面
    public function agent_list_delete(Request $request){
        $id = $request->input('id');//服务商id

        return view('Zerone/agent/agent_list_delete');
    }
//服务商下级人员架构
    public function agent_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $request->input('organization_id');//服务商id

        $listOrg = Organization::getOneagent([['id',$organization_id]]);
        $oneOrg = Account::getOne([['organization_id',$organization_id],['parent_id','1']]);
        $list = Account::getList([['organization_id',$organization_id],['parent_tree','like','%'.$oneOrg['parent_tree'].$oneOrg['id'].',%']],0,'id','asc')->toArray();
        $structure = $this->account_structure($list,$oneOrg['id']);
        return view('Zerone/agent/agent_structure',['listOrg'=>$listOrg,'oneOrg'=>$oneOrg,'structure'=>$structure,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
       /*
        * 递归生成人员结构的方法
        * $list - 结构所有人员的无序列表
        * $id - 上级ID
        */
    private function account_structure($list,$id){
        $structure = '';
        foreach($list as $key=>$val){

            if($val['parent_id'] == $id) {
                unset($list[$key]);
                $val['sonlist'] = $this->account_structure($list, $val['id']);
                //$arr[] = $val;
                $structure .= '<ol class="dd-list"><li class="dd-item" data-id="' . $val['id'] . '">' ;
                $structure .= '<div class="dd-handle">';
                $structure .= '<span class="pull-right">创建时间：'.date('Y-m-d,H:i:s',$val['created_at']).'</span>';
                $structure .= '<span class="label label-info"><i class="fa fa-user"></i></span>';
                $structure .=  $val['account']. '-'.$val['account_info']['realname'];
                if(!empty($val['account_roles'])){
                    $structure.='【'.$val['account_roles'][0]['role_name'].'】';
                }
                $structure .= '</div>';
                $son_menu = $this->account_structure($list, $val['id']);
                if (!empty($son_menu)) {
                    $structure .=  $son_menu;
                }
                $structure .= '</li></ol>';
            }
        }
        return $structure;
    }

    //服务商程序管理
    public function agent_program(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $request->input('organization_id');//服务商id
        $listOrg = Organization::getOneagent([['id',$organization_id]]);
        $list = Package::getPaginage([],15,'id');
        foreach ($list as $key=>$value){
            foreach ($value['programs'] as $k=>$v){
                $re = Assets::getOne([['organization_id',$organization_id],['package_id',$value['id']],['program_id',$v['id']]]);
                $list[$key]['programs'][$k]['program_spare_num'] = $re['program_spare_num'];
                $list[$key]['programs'][$k]['program_use_num'] = $re['program_use_num'];
            }
        }
        return view('Zerone/agent/agent_program',['list'=>$list,'listOrg'=>$listOrg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //服务商程序管理页面划入js显示
    public function agent_assets(Request $request){
        $organization_id = $request->input('organization_id'); //服务商id
        $package_id = $request->input('package_id');//套餐id
        $listOrg = Organization::getOneagent([['id',$organization_id]]);
        $listPac = Package::getOnePackage([['id',$package_id]]);
        $status = $request->input('status');//状态
        return view('Zerone/agent/agent_assets',['listOrg'=>$listOrg,'listPac'=>$listPac,'status'=>$status]);
    }

    //服务商程序管理页面划入划出检测
    public function agent_assets_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数

        if($admin_data['organization_id'] == 0){//超级管理员没有组织id，操作默认为零壹公司操作
            $draw_organization_id = 1;
        }else{
            $draw_organization_id = $admin_data['organization_id'];
        }

        $organization_id = $request->input('organization_id');//服务商id
        $package_id = $request->input('package_id');//套餐id
        $program_id = $request->input('program_id');//程序id
        $number = $request->input('num');//数量
        $status = $request->input('status');//判断划入或者划出
        DB::beginTransaction();
        try{
            $re = Assets::getOne([['organization_id',$organization_id],['package_id',$package_id],['program_id',$program_id]]);
            $id=$re['id'];
            if($status == '1'){//划入
                if(empty($re)){
                    Assets::addAssets(['organization_id'=>$organization_id,'package_id'=>$package_id,'program_id'=>$program_id,'program_spare_num'=>$number,'program_use_num'=>'0']);
                }else{
                    $num = $re['program_spare_num']+$number;
                    Assets::editAssets([['id',$id]],['program_spare_num'=>$num]);
                }
                $data = ['account_id'=>$admin_data['id'],'organization_id'=>$organization_id,'draw_organization_id'=>$draw_organization_id,'program_id'=>$program_id,'package_id'=>$package_id,'status'=>$status,'number'=>$number];
                //添加操作日志
                AssetsOperation::addAssetsOperation($data);//保存操作记录
            } else{//划出
                if(empty($re)){
                    return response()->json(['data' => '数量不足', 'status' => '0']);
                }else{
                    if($re['program_spare_num'] >= $number){//划出数量小于或等于剩余数量
                        $num = $re['program_spare_num'] - $number;
                        Assets::editAssets([['id',$id]],['program_spare_num'=>$num]);
                    }else{
                        return response()->json(['data' => '数量不足', 'status' => '0']);
                    }
                }
                $data = ['account_id'=>$admin_data['id'],'organization_id'=>$organization_id,'draw_organization_id'=>$draw_organization_id,'program_id'=>$program_id,'package_id'=>$package_id,'status'=>$status,'number'=>$number];
                //添加操作日志
                AssetsOperation::addAssetsOperation($data);//保存操作记录
            }
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '操作失败', 'status' => '0']);
        }
        return response()->json(['data' => '操作成功', 'status' => '1']);
    }
    //服务商程序管理
    public function agent_company(Request $request){

        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Zerone/agent/agent_company',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
}
?>