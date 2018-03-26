<?php
namespace App\Http\Controllers\Fansmanage;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\WechatAuthorization;
use App\Models\WechatAuthorizerInfo;
use App\Models\WechatImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class ApiController extends Controller{
    /*
     * 公众号管理
     */
    public function store_auth(Request $request){
        $admin_data = $request->get('admin_data');      //中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');        //中间件产生的菜单数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的子菜单数据参数
        $route_name = $request->path();                     //获取当前的页面路由
        $url = "";
        if(!WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]])){
            $url = \Wechat::get_auth_url($admin_data['organization_id'],$route_name);
        }
        $wechat_info = [];
        $org_info = Organization::where('id',$admin_data['organization_id'])->first();
        if(isset($org_info->wechatAuthorization)) {//如果该组织授权了公众号

            $wechat_info = $org_info->wechatAuthorization->wechatAuthorizerInfo;//获取公众号信息

            //如果没有带参数的二维码
            if(empty($wechat_info['zerone_qrcode_url'])) {
                /**获取公众号带参数关注二维码**/
                $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌

                $imgre = \Wechat::createQrcode($auth_info['authorizer_access_token'], $admin_data['organization_id']);//测试创建临时二维码

                if ($imgre) {
                    WechatAuthorizerInfo::editAuthorizerInfo([['id',$org_info->wechatAuthorization->id]],['zerone_qrcode_url'=>$imgre]);
                    $wechat_info['zerone_qrcode_url'] = $imgre;
                }
            }
        }

        return view('Fansmanage/Api/store_auth',['url'=>$url,'wechat_info'=>$wechat_info,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);

    }

    /**************************************************************************图文素材开始*********************************************************************************/
    /*
     * 图片素材
     */
    public function material_image(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = WechatImage::getPaginage([['organization_id',$admin_data['organization_id']]],30,'id',$sort='DESC');
        return view('Fansmanage/Api/material_image',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 图片素材上传
     */
    public function meterial_image_upload(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/material_image_upload',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }


}
?>