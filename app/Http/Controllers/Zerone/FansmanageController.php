<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\OrganizationFansmanageapply;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\Organizationfansmanageinfo;
use App\Models\AccountNode;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class FansmanageController extends Controller{

    //商户审核列表
    public function fansmanage_examinelist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $fansmanage_name = $request->input('fansmanage_name');
        $fansmanage_owner_mobile = $request->input('fansmanage_owner_mobile');
        $search_data = ['fansmanage_name'=>$fansmanage_name,'fansmanage_owner_mobile'=>$fansmanage_owner_mobile];
        $where = [['status','<>','1']];
        if(!empty($fansmanage_name)){
            $where[] = ['fansmanage_name','like','%'.$fansmanage_name.'%'];
        }

        if(!empty($fansmanage_owner_mobile)){
            $where[] = ['fansmanage_owner_mobile',$fansmanage_owner_mobile];
        }

        $list = OrganizationFansmanageapply::getPaginage($where,'15','id');
        return view('Zerone/Fansmanage/fansmanage_examinelist',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户审核ajaxshow显示页面
    public function fansmanage_examine(Request $request){
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//是否通过值 1为通过 -1为不通过
        $info =  OrganizationFansmanageapply::getOne([['id',$id]]);//获取该ID的信息
        return view('Zerone/Fansmanage/fansmanage_examine',['info'=>$info,'status'=>$status]);
    }
    //商户审核数据提交
    public function fansmanage_examine_check(Request $request){
        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//查找当前操作人员数据
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//商户id
        $status = $request->input('status');//是否通过值 1为通过 -1为不通过
        $oneFansmanage = OrganizationFansmanageapply::getOne([['id',$id]]);//查询申请服务商信息

        if($status == -1 ){
            DB::beginTransaction();
            try{
                OrganizationFansmanageapply::editFansmanageApply([['id',$id]],['status'=>$status]);//拒绝通过
                //添加操作日志
                OperationLog::addOperationLog('1','1',$admin_this['id'],$route_name,'拒绝了商户：'.$oneFansmanage['fansmanage_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '拒绝失败', 'status' => '0']);
            }
            return response()->json(['data' => '拒绝成功', 'status' => '1']);
        }elseif($status == 1){

            $list = Organization::getOneProxy([['id',$id]]);

            $parent_id = $id;//零壹或者服务商organization_id
            $parent_tree = $list['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
            $mobile = $oneFansmanage['fansmanage_owner_mobile'];//手机号码

            DB::beginTransaction();
            try{
                OrganizationFansmanageapply::editfansmanageApply([['id',$id]],['status'=>$status]);//申请通过
                //添加服务商
                $listdata = ['organization_name'=>$fansmanagelist['fansmanage_name'],'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'program_id'=>3,'type'=>3,'status'=>1];
                $organization_id = Organization::addOrganization($listdata); //返回值为商户的id

                $user = Account::max('account');
                $account  = $user+1;//用户账号
                $fansmanage_password =  $fansmanagelist['fansmanage_password'];//用户密码

                $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度
                $Accparent_tree = $admin_data['parent_tree'].$admin_data['id'].',';//管理员组织树
                $accdata = ['parent_id'=>$admin_data['id'],'parent_tree'=>$Accparent_tree,'deepth'=>$deepth,'mobile'=>$mobile,'password'=>$fansmanage_password,'organization_id'=>$organization_id,'account'=>$account];
                $account_id = Account::addAccount($accdata);//添加账号返回id

                $realname = $fansmanagelist['fansmanage_owner'];//负责人姓名
                $idcard = $fansmanagelist['fansmanage_owner_idcard'];//负责人身份证号
                $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
                AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

                $fansmanageinfo = ['organization_id'=>$organization_id, 'fansmanage_owner'=>$realname, 'fansmanage_owner_idcard'=>$idcard, 'fansmanage_owner_mobile'=>$fansmanagelist['fansmanage_owner_mobile']];

                Organizationfansmanageinfo::addOrganizationfansmanageinfo($fansmanageinfo);  //添加到服务商组织信息表

                //添加操作日志
                OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'服务商审核通过：'.$fansmanagelist['fansmanage_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '审核失败', 'status' => '0']);
            }
            return response()->json(['data' => '申请通过', 'status' => '1']);
        }
    }









    //添加服务商
    public function fansmanage_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = Organization::whereIn('type',[1,2])->where([['status','1']])->get();

        return view('Zerone/Fansmanage/fansmanage_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'list'=>$list]);
    }
    //注册提交商户数据
    public function fansmanage_add_check(Request $request){
        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('organization_id');//零壹或者服务商organization_id
        $organization_name = $request->input('organization_name');//商户名称
        $where = [['organization_name',$organization_name],['id','<>',$id]];

        $name = Organization::checkRowExists($where);

        if($name == 'true'){
            return response()->json(['data' => '商户已存在', 'status' => '0']);
        }


        $list = Organization::getOneProxy([['id',$id]]);

        $parent_id = $id;//上级组织 零壹或者服务商organization_id
        $parent_tree = $list['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
        $mobile = $request->input('mobile');//手机号码

        $password = $request->input('password');//用户密码
        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        $program_id = 3; //'商户组织默认为3'
        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$organization_name,'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'program_id'=>$program_id,'type'=>3,'status'=>1];
            $organization_id = Organization::addOrganization($listdata); //返回值为商户的id

            $user = Account::max('account');
            $account  = $user+1;//用户账号

            $Accparent_tree = $admin_data['parent_tree'].$admin_data['id'].',';//管理员组织树
            $accdata = ['parent_id'=>$admin_data['id'],'parent_tree'=>$Accparent_tree,'deepth'=>$admin_data['deepth']+1,'mobile'=>$mobile,'password'=>$encryptPwd,'organization_id'=>$organization_id,'account'=>$account];
            $account_id = Account::addAccount($accdata);//添加账号返回id

            $realname = $request->input('realname');//负责人姓名
            $idcard = $request->input('idcard');//负责人身份证号
            $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
            AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

            $comproxyinfo = ['organization_id'=>$organization_id, 'fansmanage_owner'=>$realname, 'fansmanage_owner_idcard'=>$idcard, 'fansmanage_owner_mobile'=>$mobile];

            Organizationfansmanageinfo::addOrganizationfansmanageinfo($comproxyinfo);  //添加到服务商组织信息表

            $module_node_list = Module::getListProgram($program_id, [], 0, 'id');//获取当前系统的所有节点
            foreach($module_node_list as $key=>$val){
                foreach($val->program_nodes as $k=>$v) {
                    AccountNode::addAccountNode(['account_id' => $account_id, 'node_id' => $v['id']]);
                }
            }
            //添加操作日志
            OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'添加了商户：'.$organization_name);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '注册失败', 'status' => '0']);
        }
        return response()->json(['data' => '注册成功', 'status' => '1']);

    }


    //服务商列表
    public function fansmanage_list(Request $request){

        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $organization_name = $request->input('organization_name');
        $fansmanage_owner_mobile = $request->input('fansmanage_owner_mobile');

        $search_data = ['organization_name'=>$organization_name,'fansmanage_owner_mobile'=>$fansmanage_owner_mobile];
        $where = [['type','3']];
        if(!empty($organization_name)){
            $where[] = ['organization_name','like','%'.$organization_name.'%'];
        }

        $listorg = Organization::getfansmanage($where,'5','id');
        foreach ($listorg as $k=>$v){
            $listorg[$k]['account'] = Account::getPluck(['organization_id'=>$v['id'],'parent_id'=>'1'],'account')->first();
            $listorg[$k]['proxy_name'] = Organization::getPluck(['id'=>$v['parent_id']],'organization_name')->first();
        }
        return view('Zerone/fansmanage/fansmanage_list',['search_data'=>$search_data,'listorg'=>$listorg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户编辑ajaxshow显示页面
    public function fansmanage_list_edit(Request $request){
        $id = $request->input('id');//服务商id
        $listorg = Organization::getOnefansmanage([['id',$id]]);
        $proxy = Organization::whereIn('type',[1,2])->where([['status','1']])->get();
        return view('Zerone/fansmanage/fansmanage_list_edit',compact('listorg','proxy'));
    }
    //服务商编辑功能提交
    public function fansmanage_list_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $parent_id = $request->input('parent_id');//上级id

        $organization_name = $request->input('organization_name');//服务商名称
        $realname = $request->input('realname');//用户名字
        $idcard = $request->input('idcard');//用户身份证号
        $mobile = $request->input('mobile');//用户手机号
        $password = $request->input('password');//登入密码

        DB::beginTransaction();
        try{
            $list = Organization::getOnefansmanage(['id'=>$id]); //获取商户组织信息
            $acc = Account::getOne(['organization_id'=>$id,'parent_id'=>'1']);//获取商户负责人信息
            if($list['organization_name']!=$organization_name){
                Organization::editOrganization(['id'=>$id], ['organization_name'=>$organization_name]);//修改服务商表服务商名称
            }
            if($list['mobile']!=$mobile){
                Organizationfansmanageinfo::editOrganizationfansmanageinfo(['organization_id'=>$id], ['fansmanage_owner_mobile'=>$mobile]);//修改商户表商户手机号码
                Account::editAccount(['organization_id'=>$id],['mobile'=>$mobile]);//修改用户管理员信息表 手机号
            }

            if($list['organizationfansmanageinfo']['fansmanage_owner'] != $realname){
                $fansmanagedata = ['fansmanage_owner'=>$realname];
                Organizationfansmanageinfo::editOrganizationfansmanageinfo(['organization_id'=>$id],$fansmanagedata);//修改商户信息表 用户姓名
                AccountInfo::editAccountInfo(['account_id'=>$acc['id']],['realname'=>$realname]);//修改用户管理员信息表 用户名
            }
            if(!empty($password)){
                $key = config("app.zerone_encrypt_key");//获取加密盐
                $encrypted = md5($password);//加密密码第一重
                $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
                $accountdata = ['password'=>$encryptPwd];
                Account::editAccount(['organization_id'=>$id,'parent_id'=>'1'],$accountdata);//修改管理员表登入密码
            }
            if($acc['idcard'] != $idcard){
                AccountInfo::editAccountInfo(['account_id'=>$acc['id']],['idcard'=>$idcard]);//修改用户管理员信息表 身份证号
                Organizationfansmanageinfo::editOrganizationfansmanageinfo(['organization_id'=>$id],['fansmanage_owner_idcard'=>$idcard]);//修改商户信息表 身份证号
            }

            if($list['parent_id'] != $parent_id){
                $porxy = Organization::getOneProxy(['id'=>$parent_id]); //获取选择更换的上级服务商信息
                $parent_tree = $porxy['parent_tree'].$parent_id.',';//组织树
                $data = ['parent_id'=>$parent_id,'parent_tree'=>$parent_tree];
                Organization::editOrganization(['id'=>$id],$data);//修改商户的上级服务商信息
            }

            //添加操作日志
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了商户：'.$list['organization_name']);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改失败', 'status' => '0']);
        }
        return response()->json(['data' => '修改成功', 'status' => '1']);
    }

    //商户冻结ajaxshow显示页面
    public function fansmanage_list_frozen(Request $request){
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//冻结操作状态
        $list = Organization::getOneProxy([['id',$id]]);//服务商信息
        return view('Zerone/fansmanage/fansmanage_list_frozen',['id'=>$id,'list'=>$list,'status'=>$status]);
    }
    //商户冻结功能提交
    public function fansmanage_list_frozen_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $status = $request->input('status');//冻结操作状态
        $list = Organization::getOneProxy([['id',$id]]);
        DB::beginTransaction();
        try{
            if($status == '1'){
                Organization::editOrganization([['id',$id]],['status'=>'0']);
                Account::editOrganizationBatch([['organization_id',$id]],['status'=>'0']);
                //添加操作日志
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'冻结了服务商：'.$list['organization_name']);//保存操作记录
            }
            elseif($status == '0'){
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
    //商户删除ajaxshow显示页面
    public function fansmanage_list_delete(Request $request){
//        $id = $request->input('id');//服务商id
//        $listorg = Organization::getOneProxy(['id'=>$id]);
//        $warzone = Warzone::all();
        return view('Zerone/fansmanage/fansmanage_list_delete');
    }

    //商户下级店铺架构
    public function fansmanage_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $organization_id = $request->input('organization_id');//服务商id
        $listOrg = Organization::getOnefansmanage([['id',$organization_id]]);
        $list = Organization::getArrayfansmanage([['parent_tree','like','%'.$listOrg['parent_tree'].$listOrg['id'].',%']],0,'id','asc')->toArray();
        $structure = $this->Com_structure($list,$organization_id);
        return view('Zerone/fansmanage/fansmanage_structure',['listOrg'=>$listOrg,'structure'=>$structure,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }



    private function Com_structure($list,$id){
        $structure = '';
        foreach($list as $key=>$val){
            if($val['parent_id'] == $id) {
                unset($list[$key]);
                $val['sonlist'] = $this->Com_structure($list, $val['id']);
                //$arr[] = $val;
                $structure .= '<ol class="dd-list"><li class="dd-item" data-id="' . $val['id'] . '">' ;
                $structure .= '<div class="dd-handle">';
                $structure .= '<span class="pull-right">创建时间：'.date('Y-m-d,H:i:s',$val['created_at']).'</span>';
                $structure .= '<span class="label label-info"><i class="fa fa-user"></i></span>';
                $structure .= '【商户】'. $val['organization_name']. '-'.$val['organization_fansmanageinfo']['fansmanage_owner'].'-'.$val['organization_fansmanageinfo']['fansmanage_owner_mobile'];
                $structure .= '</div>';
                $son_menu = $this->Com_structure($list, $val['id']);
                if (!empty($son_menu)) {
                    $structure .=  $son_menu;
                }
                $structure .= '</li></ol>';
            }
        }
        return $structure;
    }

    //商户程序管理
    public function fansmanage_program(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_id = $request->input('organization_id');//服务商id
        $listOrg = Organization::getOneProxy([['id',$organization_id]]);

        $list = Package::getPaginage([],15,'id');
        foreach ($list as $key=>$value){
            foreach ($value['programs'] as $k=>$v){
                $re = Assets::getOne([['organization_id',$organization_id],['package_id',$value['id']],['program_id',$v['id']]]);
                $list[$key]['programs'][$k]['program_spare_num'] = $re['program_spare_num'];
                $list[$key]['programs'][$k]['program_use_num'] = $re['program_use_num'];
            }
        }
        return view('Zerone/fansmanage/fansmanage_program',['list'=>$list,'listOrg'=>$listOrg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户资产页面划入js显示
    public function fansmanage_assets(Request $request){
        $organization_id = $request->input('organization_id');//服务商id
        $package_id = $request->input('package_id');//套餐id
        $status = $request->input('status');//状态
        $listOrg = Organization::getOneProxy([['id',$organization_id]]);
        $listPac = Package::getOnePackage([['id',$package_id]]);

        return view('Zerone/fansmanage/fansmanage_assets',['listOrg'=>$listOrg, 'listPac'=>$listPac ,'status'=>$status]);
    }
    //商户资产页面划入js显示
    public function fansmanage_assets_check(Request $request){
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
    //商户程序管理
    public function fansmanage_store(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Zerone/fansmanage/fansmanage_store',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

}
?>