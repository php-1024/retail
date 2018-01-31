<?php
namespace App\Http\Controllers\Proxy;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Assets;
use App\Models\Organization;
use App\Models\Package;
use App\Models\ProxyApply;
use Illuminate\Http\Request;
use Session;
class CompanyController extends Controller{
    //商户注册列表
    public function company_register(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $proxy_name = $request->input('proxy_name');
        $proxy_owner_mobile = $request->input('proxy_owner_mobile');
        $search_data = ['proxy_name'=>$proxy_name,'proxy_owner_mobile'=>$proxy_owner_mobile];

        $where = [['parent_id',$admin_data['organization_id']]];
        if(!empty($proxy_name)){
            $where[] = ['proxy_name','like','%'.$proxy_name.'%'];
        }
        if(!empty($proxy_owner_mobile)){
            $where[] = ['proxy_owner_mobile',$proxy_owner_mobile];
        }
        $list = ProxyApply::getPaginage($where,'15','id');
        return view('Proxy/Company/company_register',['list'=>$list,'search_data'=>$search_data,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    //商户列表
    public function company_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $organization = $admin_data['organization_id'];
        $list = Organization::getCompany([['parent_id',$organization],['program_id',3]],10,'id');
        foreach ($list as $key=>$val){
            $list[$key]['account'] = Account::getPluck([['organization_id',$val['id']],['parent_id',1]],'account')->first();
        }
        return view('Proxy/Company/company_list',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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


}
?>