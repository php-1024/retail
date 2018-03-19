<?php
namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Assets;
use App\Models\AssetsOperation;
use App\Models\Organization;
use App\Models\OrganizationFansmanageapply;
use App\Models\Package;
use App\Models\ProxyApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class FansmanageController extends Controller{
    //商户注册列表
    public function fansmana_register(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $fansmana_name = $request->input('fansmana_name');
        $fansmana_owner_mobile = $request->input('fansmana_owner_mobile');
        $search_data = ['fansmana_name'=>$fansmana_name,'fansmana_owner_mobile'=>$fansmana_owner_mobile];

        $where = [['parent_id',$admin_data['organization_id']]];
        if(!empty($fansmana_name)){
            $where[] = ['fansmana_name','like','%'.$fansmana_name.'%'];
        }
        if(!empty($fansmana_owner_mobile)){
            $where[] = ['fansmana_owner_mobile',$fansmana_owner_mobile];
        }
        $list = OrganizationFansmanageapply::getPaginage($where,'15','id');
        return view('Agent/Fansmana/fansmana_register',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户列表
    public function fansmana_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization = $admin_data['organization_id'];
        $list = Organization::getPaginageFansmanage([['parent_id',$organization],['program_id',3]],10,'id');
        foreach ($list as $key=>$val){
            $list[$key]['account'] = Account::getPluck([['organization_id',$val['id']],['parent_id',1]],'account')->first();
        }
        return view('Agent/Fansmana/fansmana_list',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //店铺结构
    public function company_structure(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $organization_id = $request->input('organization_id');//当前组织ID，零壹管理平台组织只能为1
        $oneAcc = Account::getOne([['organization_id',$organization_id],['parent_id',1]]);//查找服务商对应的负责人信息
        $parent_tree = $oneAcc['parent_tree'];//组织树
        //获取重Admin开始的的所有人员
        $list = Account::getList([['organization_id',$organization_id],['parent_tree','like','%'.$parent_tree.$oneAcc['id'].',%']],0,'id','asc')->toArray();
        //根据获取的人员组成结构树
        $structure = $this->create_structure($list,$oneAcc['id']);
        return view('Proxy/Company/company_structure',['oneAcc'=>$oneAcc,'structure'=>$structure,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    private function create_structure($list,$id){
        $structure = '';
        foreach($list as $key=>$val){
            if($val['parent_id'] == $id) {
                $structure .= '<ol class="dd-list"><li class="dd-item" data-id="' . $val['id'] . '">' ;
                $structure .= '<div class="dd-handle">';
                $structure .= '<span class="pull-right">创建时间：'.date('Y-m-d,H:i:s',$val['created_at']).'</span>';
                $structure .= '<span class="label label-info"><i class="icon-user"></i></span>';
                $structure .=  $val['account']. '-'.$val['account_info']['realname'];
                if(!empty($val['account_roles'])){
                    $structure.='【'.$val['account_roles'][0]['role_name'].'】';
                }
                $structure .= '</div>';
                $son_menu = $this->create_structure($list, $val['id']);
                if (!empty($son_menu)) {
                    $structure .=  $son_menu;
                }
                $structure .= '</li></ol>';
            }
        }
        return $structure;
    }

    //程序划拨
    public function company_program(Request $request){
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
        return view('Proxy/Company/company_program',['listOrg'=>$listOrg,'list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //程序划拨
    public function company_assets(Request $request){
        $organization_id = $request->input('organization_id');//服务商id
        $package_id = $request->input('package_id');//套餐id
        $status = $request->input('status');//状态
        $listOrg = Organization::getOneProxy([['id',$organization_id]]);
        $listPac = Package::getOnePackage([['id',$package_id]]);
        return view('Proxy/Company/company_assets',['listOrg'=>$listOrg, 'listPac'=>$listPac ,'status'=>$status]);
    }
    //商户资产页面划入js显示
    public function company_assets_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        if($admin_data['is_super'] == 2){//超级管理员没有组织id，操作默认为零壹公司操作
            $draw_organization_id = 1;
            $account_id = 1;
        }else{
            $draw_organization_id = $admin_data['organization_id'];
            $account_id =$admin_data['id'];
        }

        $organization_id = $request->input('organization_id');//服务商id
        $package_id = $request->input('package_id');//套餐id
        $program_id = $request->input('program_id');//程序id
        $number = $request->input('num');//数量
        $status = $request->input('status');//判断划入或者划出
        DB::beginTransaction();
        try{
            $re = Assets::getOne([['organization_id',$organization_id],['package_id',$package_id],['program_id',$program_id]]);//查询商户套餐系统数量

            $oneProxy = Assets::getOne([['organization_id',$admin_data['organization_id']],['package_id',$package_id],['program_id',$program_id]]);//查询服务商套餐系统数量
            $id=$re['id'];
            if($status == '1'){//划入
                if($oneProxy['program_spare_num'] < $number ){//数量不足
                    return response()->json(['data' => '数量不足', 'status' => '0']);
                }
                if(empty($re)){
                    Assets::addAssets(['organization_id'=>$organization_id,'package_id'=>$package_id,'program_id'=>$program_id,'program_spare_num'=>$number,'program_use_num'=>'0']);//新添加商户系统数量
                }else{
                    $num = $re['program_spare_num']+$number;
                    Assets::editAssets([['id',$id]],['program_spare_num'=>$num]);//商户原来的基础上加上系统数量
                }
                    $proxyNum = $oneProxy['program_spare_num'] - $number;//剩余数量
                    $proxyUseNum = $oneProxy['program_use_num'] + $number;//使用数量
                    Assets::editAssets([['id',$oneProxy['id']]],['program_spare_num'=>$proxyNum,'program_use_num'=>$proxyUseNum]);//修改服务商系统数量
                $data = ['account_id'=>$account_id,'organization_id'=>$organization_id,'draw_organization_id'=>$draw_organization_id,'program_id'=>$program_id,'package_id'=>$package_id,'status'=>$status,'number'=>$number];
                //添加操作日志
                AssetsOperation::addAssetsOperation($data);//保存操作记录
            } else{//划出
                if(empty($re)){
                    return response()->json(['data' => '商户系统数量不足划出', 'status' => '0']);
                }else{
                    if($re['program_spare_num'] >= $number){//划出数量小于或等于剩余数量
                        $num = $re['program_spare_num'] - $number;
                        Assets::editAssets([['id',$id]],['program_spare_num'=>$num]);
                    }else{
                        return response()->json(['data' => '商户系统数量不足划出', 'status' => '0']);
                    }
                }
                    $proxyNum = $oneProxy['program_spare_num'] + $number;//剩余数量
                    $proxyUseNum = $oneProxy['program_use_num'] - $number;//使用数量
                    Assets::editAssets([['id', $oneProxy['id']]], ['program_spare_num' => $proxyNum, 'program_use_num' => $proxyUseNum]);//修改服务商系统数量
                $data = ['account_id'=>$account_id,'organization_id'=>$organization_id,'draw_organization_id'=>$draw_organization_id,'program_id'=>$program_id,'package_id'=>$package_id,'status'=>$status,'number'=>$number];
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


}
?>