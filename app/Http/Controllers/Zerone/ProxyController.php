<?php
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\OperationLog;
use App\Models\Organization;
use App\Models\OrganizationProxyinfo;
use App\Models\WarzoneProxy;
use Illuminate\Http\Request;
use App\Models\ProxyApply;
use App\Models\Warzone;
use Illuminate\Support\Facades\DB;
use Session;
class ProxyController extends Controller{
    //添加服务商
    public function proxy_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $warzone_list = Warzone::all();

        return view('Zerone/Proxy/proxy_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data,'warzone_list'=>$warzone_list]);
    }
    //提交服务商数据
    public function proxy_add_check(Request $request){

        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization_name = $request->input('organization_name');//服务商名称

        $where = [['organization_name',$organization_name]];

        $name = Organization::checkRowExists($where);

        if($name == 'true'){
            return response()->json(['data' => '服务商名称已存在', 'status' => '0']);
        }

        $zone_id = $request->input('zone_id');//战区id
        $parent_id = $admin_data['id'];//上级ID是当前用户ID
        $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
        $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度
        $mobile = $request->input('mobile');//手机号码
        $password = $request->input('password');//用户密码

        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重
        DB::beginTransaction();
        try{
            $listdata = ['organization_name'=>$organization_name,'parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'program_id'=>$deepth,'type'=>2,'status'=>1];
            $organization_id = Organization::addProgram($listdata); //返回值为商户的id

            $proxydata = ['organization_id'=>$organization_id,'zone_id'=>$zone_id];
            WarzoneProxy::addWarzoneProxy($proxydata);//战区关联服务商

            $account  = 'P'.$mobile.'_'.$organization_id;//用户账号
            $accdata = ['parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'deepth'=>$deepth,'mobile'=>$mobile,'password'=>$encryptPwd,'organization_id'=>$organization_id,'account'=>$account];
            $account_id = Account::addAccount($accdata);//添加账号返回id
            $realname = $request->input('realname');//负责人姓名
            $idcard = $request->input('idcard');//负责人身份证号
            $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
            AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

            $orgproxyinfo = ['organization_id'=>$organization_id, 'proxy_owner'=>$realname, 'proxy_owner_idcard'=>$idcard, 'proxy_owner_mobile'=>$mobile];
            OrganizationProxyinfo::addOrganizationProxyinfo($orgproxyinfo);  //添加到服务商组织信息表
            //添加操作日志
            OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'添加了服务商：'.$organization_name);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '注册失败', 'status' => '0']);
        }
        return response()->json(['data' => '注册成功', 'status' => '1']);

    }

    //服务商审核列表
    public function proxy_examinelist(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $proxy_name = $request->input('proxy_name');
        $proxy_owner_mobile = $request->input('proxy_owner_mobile');
        $search_data = ['proxy_name'=>$proxy_name,'proxy_owner_mobile'=>$proxy_owner_mobile];
        $where = [];
        if(!empty($proxy_name)){
            $where[] = ['proxy_name','like','%'.$proxy_name.'%'];
        }

        if(!empty($proxy_owner_mobile)){
            $where[] = ['proxy_owner_mobile',$proxy_owner_mobile];
        }
        $list = ProxyApply::getPaginage($where,'15','id');
        return view('Zerone/Proxy/proxy_examinelist',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商审核ajaxshow显示页面
    public function proxy_examine(Request $request){
        $id = $request->input('id');//服务商id
        $sta = $request->input('sta');//是否通过值 1为通过 -1为不通过
        $info =  ProxyApply::getOne([['id',$id]]);//获取该ID的信息
        return view('Zerone/Proxy/proxy_examine',['info'=>$info,'sta'=>$sta]);
    }
    //服务商审核数据提交
    public function proxy_examine_check(Request $request){
        $admin_data = Account::where('id',1)->first();//查找超级管理员的数据
        $admin_this = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $sta = $request->input('sta');//是否通过值 1为通过 -1为不通过
        $proxylist = ProxyApply::getOne([['id',$id]]);//查询申请服务商信息
        if($sta == -1 ){
            DB::beginTransaction();
            try{
                ProxyApply::editProxyApply(['id'=>$id],['status'=>$sta]);//拒绝通过
                //添加操作日志
                 OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'拒绝了服务商：'.$proxylist['proxy_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '拒绝失败', 'status' => '0']);
            }
            return response()->json(['data' => '拒绝成功', 'status' => '1']);
        }elseif($sta == 1){
            DB::beginTransaction();
            try{
                ProxyApply::editProxyApply(['id'=>$id],['status'=>$sta]);//申请通过
                //添加服务商
                $listdata = ['organization_name'=>$proxylist['proxy_name'],'parent_id'=>0,'parent_tree'=>0,'program_id'=>0,'type'=>2,'status'=>1];
                $organization_id = Organization::addProgram($listdata); //返回值为商户的id

                $proxydata = ['organization_id'=>$organization_id,'zone_id'=>$proxylist['zone_id']];
                WarzoneProxy::addWarzoneProxy($proxydata);//战区关联服务商

                $account  = 'P'.$proxylist['proxy_owner_mobile'].'_'.$organization_id;//用户账号
                $parent_id = $admin_data['id'];//上级ID是当前用户ID
                $parent_tree = $admin_data['parent_tree'].$parent_id.',';//树是上级的树拼接上级的ID；
                $deepth = $admin_data['deepth']+1;  //用户在该组织里的深度

                $key = config("app.zerone_encrypt_key");//获取加密盐
                $encrypted = md5($proxylist['proxy_password']);//加密密码第一重
                $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重

                $accdata = ['parent_id'=>$parent_id,'parent_tree'=>$parent_tree,'deepth'=>$deepth,'mobile'=>$proxylist['proxy_owner_mobile'],'password'=>$encryptPwd,'organization_id'=>$organization_id,'account'=>$account];
                $account_id = Account::addAccount($accdata);//添加账号返回id

                $realname = $proxylist['proxy_owner'];//负责人姓名
                $idcard = $proxylist['proxy_owner_idcard'];//负责人身份证号
                $acinfodata = ['account_id'=>$account_id,'realname'=>$realname,'idcard'=>$idcard];
                AccountInfo::addAccountInfo($acinfodata);//添加到管理员信息表

                $orgproxyinfo = ['organization_id'=>$organization_id, 'proxy_owner'=>$realname, 'proxy_owner_idcard'=>$idcard, 'proxy_owner_mobile'=>$proxylist['proxy_owner_mobile']];
                OrganizationProxyinfo::addOrganizationProxyinfo($orgproxyinfo);  //添加到服务商组织信息表

                //添加操作日志
                OperationLog::addOperationLog('1',$admin_this['organization_id'],$admin_this['id'],$route_name,'服务商审核通过：'.$proxylist['proxy_name']);//保存操作记录
                DB::commit();//提交事务
            }catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '审核失败', 'status' => '0']);
            }
            return response()->json(['data' => '申请通过', 'status' => '1']);
        }
    }


    //服务商列表
    public function proxy_list(Request $request){

        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $listorg = Organization::getPaginage(['type'=>'2'],'5','id')->toArray();
        foreach ($listorg['warzone_proxy'] as $k=>$v){
            dd($v);
            $listorg[$k]['zone_name'] = Warzone::getPluck(['id'=>$warzone_id],'zone_name')->toArray();
        }
        return view('Zerone/Proxy/proxy_list',['listorg'=>$listorg,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //服务商编辑ajaxshow显示页面
    public function proxy_list_edit(Request $request){
        $id = $request->input('id');//服务商id
        $listorg = Organization::getOne(['id'=>$id]);
        $warzone = Warzone::all();
        return view('Zerone/Proxy/proxy_list_edit',compact('listorg','warzone'));
    }
    //服务商编辑功能提交
    public function proxy_list_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $zone_id = $request->input('zone_id');//战区id
        $organization_name = $request->input('organization_name');//服务商名称
        $realname = $request->input('realname');//用户名字
        $idcard = $request->input('idcard');//用户身份证号
        $mobile = $request->input('mobile');//用户手机号
        $password = $request->input('password');//登入密码

        DB::beginTransaction();
        try{
             $list = Organization::getOneAndorganizationproxyinfo(['id'=>$id]);
             $acc = Account::getOne(['organization_id'=>$id,'parent_id'=>'1']);
             if($list['organization_name']!=$organization_name){
                 Organization::editOrganization(['id'=>$id], ['organization_name'=>$organization_name]);//修改服务商表服务商名称
             }
             if($list['mobile']!=$mobile){
                 OrganizationProxyinfo::editOrganizationProxyinfo(['organization_id'=>$id], ['proxy_owner_mobile'=>$mobile]);//修改服务商表服务商手机号码
                 Account::editAccount(['organization_id'=>$id],['mobile'=>$mobile]);//修改用户管理员信息表 手机号
             }

             if($list['organizationproxyinfo']['proxy_owner'] != $realname){
                 $orginfodata = ['proxy_owner'=>$realname];
                 OrganizationProxyinfo::editOrganizationProxyinfo(['organization_id'=>$id],$orginfodata);//修改服务商用户信息表 用户姓名
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
                 OrganizationProxyinfo::editOrganizationProxyinfo(['organization_id'=>$id],['proxy_owner_idcard'=>$idcard]);//修改服务商信息表 身份证号
             }
             $waprlist = WarzoneProxy::getOne(['organization_id'=>$id]);
             if($waprlist['zone_id'] != $zone_id){
                 WarzoneProxy::editWarzoneProxy(['organization_id'=>$id],['zone_id'=>$zone_id]);//修改战区关联表 战区id
             }

            //添加操作日志
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了服务商：'.$list['organization_name']);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改失败', 'status' => '0']);
        }
        return response()->json(['data' => '修改成功', 'status' => '1']);
    }

    //服务商冻结ajaxshow显示页面
    public function proxy_list_frozen(Request $request){
        $id = $request->input('id');//服务商id
        $list = Organization::getOne(['id'=>$id]);//服务商信息
        return view('Zerone/Proxy/proxy_list_frozen',compact('id','list'));
    }
    //服务商冻结功能提交
    public function proxy_list_frozen_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');//服务商id
        $list = Organization::getOne(['id'=>$id]);
        DB::beginTransaction();
        try{
            Organization::editOrganization(['id'=>$id],['status'=>'0']);
            Account::editOrganizationBatch(['organization_id'=>$id],['status'=>'0']);
//            //添加操作日志
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'冻结了了服务商：'.$list['organization_name']);//保存操作记录
            DB::commit();//提交事务
        }catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '冻结失败', 'status' => '0']);
        }
        return response()->json(['data' => '冻结成功', 'status' => '1']);
    }
    //服务商删除ajaxshow显示页面
    public function proxy_list_delete(Request $request){
//        $id = $request->input('id');//服务商id
//        $listorg = Organization::getOne(['id'=>$id]);
//        $warzone = Warzone::all();
        return view('Zerone/Proxy/proxy_list_delete');
    }
//服务商下级人员架构
    public function proxy_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = Account::getList([['organization_id','7'],['parent_tree','like','%'.$admin_data['parent_tree'].','.$admin_data['id'].'%']],0,'id','asc')->toArray();
        $structure = $this->proxy_str($list,$admin_data['id']);
        return view('Zerone/Proxy/proxy_structure',['structure'=>$structure,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }


    private function proxy_str($list,$id){
        $structure = '';
        foreach($list as $key=>$val){
            if($val['parent_id'] == $id) {
                unset($list[$key]);
                $val['sonlist'] = $this->proxy_str($list, $val['id']);
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
                $son_menu = $this->proxy_str($list, $val['id']);
                if (!empty($son_menu)) {
                    $structure .=  $son_menu;
                }
                $structure .= '</li></ol>';
            }
        }
        return $structure;
    }


}
?>