<?php
namespace App\Http\Controllers\Fansmanage;
use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\OperationLog;
use App\Models\WechatAuthorization;
use App\Models\WechatConditionalMenu;
use App\Models\WechatDefinedMenu;
use App\Models\WechatReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class WechatmenuController extends Controller{
    /**************************************************************************自定义菜单，个性化菜单开始*********************************************************************************/
    public function defined_menu(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Fansmanage/Wechatmenu/defined_menu',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    //自定义菜单添加页面
    public function wechat_menu_add(Request $request){
        return view('Fansmanage/Wechatmenu/wechat_menu_add');
    }

    //自定义菜单添加页面
    public function wechat_menu_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $organization_id = $admin_data['organization_id'];
        $list = WechatDefinedMenu::ListWechatDefinedMenu([['parent_id','0'],['organization_id',$organization_id]]);
        foreach($list as $key=>$value){
            $parent_tree = $value['parent_tree'].$value['id'].',';
            $re = WechatDefinedMenu::ListWechatDefinedMenu([['parent_tree',$parent_tree]])->toArray();
            if($re){
                foreach($re as $k=>$v){
                    switch ($v['event_type'])
                    {
                        case 1:
                            $type='view';
                            break;
                        case 2:
                            $type='click';
                            break;
                        case 3:
                            $type='scancode_push';
                            break;
                        case 4:
                            $type='scancode_waitmsg';
                            break;
                        case 5:
                            $type='pic_sysphoto';
                            break;
                        case 6:
                            $type='pic_photo_or_album';
                            break;
                        case 7:
                            $type='pic_weixin';
                            break;
                        case 8:
                            $type='location_select';
                            break;
                    }
                    $data['button'][$key]['name'] = $value['menu_name'];
                    if($v['event_type']==1){
                        $data['button'][$key]['sub_button'][] = [
                            'name'=>$v['menu_name'],
                            'type'=>$type,
                            'url' =>$v['response_url']
                        ];
                    }else{
                        $data['button'][$key]['sub_button'][] = [
                            'name'=>$v['menu_name'],
                            'type'=>$type,
                            'key' =>$v['response_keyword']
                        ];
                    }
                }
            }else{
                switch ($value['event_type'])
                {
                    case 1:
                        $type='view';
                        break;
                    case 2:
                        $type='click';
                        break;
                    case 3:
                        $type='scancode_push';
                        break;
                    case 4:
                        $type='scancode_waitmsg';
                        break;
                    case 5:
                        $type='pic_sysphoto';
                        break;
                    case 6:
                        $type='pic_photo_or_album';
                        break;
                    case 7:
                        $type='pic_weixin';
                        break;
                    case 8:
                        $type='location_select';
                        break;
                }
                $data['button'][$key]['name'] = $value['menu_name'];
                $data['button'][$key]['type'] = $type;
                if($value['event_type'] == 1){
                    $data['button'][$key]['url']= $value['response_url'];
                }else{
                    $data['button'][$key]['key']= $value['response_keyword'];
                }
            }
        }
        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
        $re = \Wechat::create_menu($auth_info['authorizer_access_token'],$data);
        $re = json_decode($re,true);
        if($re['errmsg'] == 'ok'){
            return response()->json(['data' => '同步成功！', 'status' => '1']);
        }else{
            return response()->json(['data' => '同步失败！', 'status' => '1']);
        }
    }

    //自定义菜单添加页面
    public function defined_menu_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        //获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]);
        //获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']]],0,'id','DESC');
        //获取菜单列表
        $list = WechatDefinedMenu::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']],['parent_id','0']],0,'id','DESC');
        return view('Fansmanage/Wechatmenu/defined_menu_add',['list'=>$list,'wechatreply'=>$wechatreply]);
    }

    //添加自定义菜单检测
    public function defined_menu_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $event_type = $request->get('event_type');  //获取事件类型
        $response_type = $request->get('response_type'); //获取响应类型
        $organization_id = $admin_data['organization_id'];  //组织ID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]); //获取授权APPID
        $menu_name = $request->get('menu_name');                //获取菜单名称
        $parent_id = $request->get('parent_id');                //获取上级菜单ID
        if ($parent_id == 0){
            $parent_tree = '0,';
        }else{
            $parent_tree = '0,'.$parent_id.',';
        }
        $response_url = $request->get('response_url');          //获取响应网址
        $response_keyword = $request->get('response_keyword');  //获取响应关键字
        $defined_menu = [
            'organization_id' => $organization_id,
            'authorizer_appid' => $authorization['authorizer_appid'],
            'menu_name' => $menu_name,
            'parent_id' => $parent_id,
            'parent_tree' => $parent_tree,
            'event_type' => $event_type,
            'response_type' => $response_type,
            'response_url' => $response_url,
            'response_keyword' => $response_keyword,
        ];

        $count = WechatDefinedMenu::getCount([['organization_id',$admin_data['organization_id']],['parent_id',$parent_id]]);
        if($parent_id == '0' && $count >= 3){
            return response()->json(['data' => '主菜单最多只能添加三条', 'status' => '0']);
        }
        if($parent_id <> '0' && $count >= 5){
            return response()->json(['data' => '子菜单只能添加5条', 'status' => '0']);
        }

        DB::beginTransaction();
        try {
            WechatDefinedMenu::addDefinedMenu($defined_menu);
            //添加操作日志
            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在餐饮系统添加了公众号自定义菜单！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('4',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了公众号自定义菜单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加自定义菜单成功！', 'status' => '1']);
    }

    public function defined_menu_get(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        //获取菜单列表
        $list = WechatDefinedMenu::getList([['organization_id',$admin_data['organization_id']],['parent_id','0']],0,'id','asc');
        $son_menu = [];
        foreach ($list as $key=>$val){
            $sm = WechatDefinedMenu::getList([['organization_id',$admin_data['organization_id']],['parent_id',$val->id]],0,'id','asc');

            if(!empty($sm)){
                $son_menu[$val->id] = $sm;
            }
            unset($sm);
        }
        return view('Fansmanage/Wechatmenu/defined_menu_get',['list'=>$list,'son_menu'=>$son_menu]);
    }


    //自定义菜单编辑页面
    public function defined_menu_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->get('id');
        $definedmenu = WechatDefinedMenu::getOne([['id',$id]]);
        //获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]);
        //获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']]],0,'id','DESC');

        //获取菜单列表
        $list = WechatDefinedMenu::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']],['parent_id','0']],0,'id','DESC');
        return view('Fansmanage/Wechatmenu/defined_menu_edit',['list'=>$list,'wechatreply'=>$wechatreply,'definedmenu'=>$definedmenu]);
    }

    //编辑自定义菜单检测
    public function defined_menu_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $event_type = $request->get('event_type');  //获取事件类型
        $menu_id = $request->get('menu_id');    //菜单ID
        $organization_id = $admin_data['organization_id'];  //组织ID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]); //获取授权APPID
        $menu_name = $request->get('menu_name');                //获取菜单名称
        $parent_id = $request->get('parent_id');                //获取上级菜单ID

        $menu_parent_id =WechatDefinedMenu::getPluck([['id',$menu_id]],'parent_id')->first();//获取菜单的上级id
        if($menu_parent_id !=$parent_id){//如果id有改变
            $count = WechatDefinedMenu::getCount([['organization_id',$admin_data['organization_id']],['parent_id',$parent_id]]);
            if($parent_id == '0' && $count >= 3){
                return response()->json(['data' => '主菜单最多只能添加三条', 'status' => '0']);
            }
            if($parent_id <> '0' && $count >= 5){
                return response()->json(['data' => '子菜单只能添加5条', 'status' => '0']);
            }
        }

        if ($parent_id == 0){
            $parent_tree = '0,';
        }else{
            $parent_tree = '0,'.$parent_id.',';
        }
        $response_url = $request->get('response_url');          //获取响应网址
        $response_keyword = $request->get('response_keyword');  //获取响应关键字
        $response_type = $request->get('response_type'); //获取响应类型
        $defined_menu = [
            'organization_id' => $organization_id,
            'authorizer_appid' => $authorization['authorizer_appid'],
            'menu_name' => $menu_name,
            'parent_id' => $parent_id,
            'parent_tree' => $parent_tree,
            'event_type' => $event_type,
            'response_type' => $response_type,
            'response_url' => $response_url,
            'response_keyword' => $response_keyword,
        ];
        DB::beginTransaction();
        try {
            WechatDefinedMenu::editDefinedMenu(['id'=>$menu_id],$defined_menu);
            //添加操作日志

            if ($admin_data['is_super'] == 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('1','1','1',$route_name,'在餐饮系统修改了公众号自定义菜单！');//保存操作记录
            }else{//商户本人操作记录
                OperationLog::addOperationLog('4',$admin_data['organization_id'],$admin_data['id'],$route_name, '修改了公众号自定义菜单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自定义菜单成功！', 'status' => '1']);
    }


    //自定义菜单删除弹窗
    public function defined_menu_delete(Request $request){
        $id = $request->get('id');
        return view('Fansmanage/Wechatmenu/defined_menu_delete',['id'=>$id]);
    }

    //自定义菜单删除检测
    public function defined_menu_delete_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->get('id');//菜单id

        DB::beginTransaction();
        try {
            $data = WechatDefinedMenu::getOne([['id',$id]]);//菜单详情信息
            if($data['parent_id'] == 0){//如果是最上级
                $parent_tree = '0,'.$id.',';//树形结构
                WechatDefinedMenu::removeDefinedMenu([['parent_tree',$parent_tree]]);//删除子级菜单
            }
            WechatDefinedMenu::removeDefinedMenu([['id',$id]]);//删除顶级菜单
            //添加操作日志
            if ($admin_data['is_super'] != 2){//超级管理员操作商户的记录
                OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name, '删除了公众号自定义菜单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除自定义菜单成功！', 'status' => '1']);
    }
    /**************************************************************************自定义菜单，个性化菜单结束*********************************************************************************/

    public function conditional_menu(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
//        $organization_id = $admin_data['organization_id'];
//        $list = WechatDefinedMenu::ListWechatDefinedMenu([['parent_id','0'],['organization_id',$organization_id]]);
//        foreach($list as $key=>$value){
//            $parent_tree = $value['parent_tree'].$value['id'].',';
//            $re = WechatDefinedMenu::ListWechatDefinedMenu([['parent_tree',$parent_tree]])->toArray();
//            if($re){
//                foreach($re as $k=>$v){
//                    switch ($v['event_type'])
//                    {
//                        case 1:
//                            $type='view';
//                            break;
//                        case 2:
//                            $type='click';
//                            break;
//                        case 3:
//                            $type='scancode_push';
//                            break;
//                        case 4:
//                            $type='scancode_waitmsg';
//                            break;
//                        case 5:
//                            $type='pic_sysphoto';
//                            break;
//                        case 6:
//                            $type='pic_photo_or_album';
//                            break;
//                        case 7:
//                            $type='pic_weixin';
//                            break;
//                        case 8:
//                            $type='location_select';
//                            break;
//                    }
//                    $data['button'][$key]['name'] = $value['menu_name'];
//                    if($v['event_type']==1){
//                        $data['button'][$key]['sub_button'][] = [
//                            'name'=>$v['menu_name'],
//                            'type'=>$type,
//                            'url' =>$v['response_url']
//                        ];
//                    }else{
//                        $data['button'][$key]['sub_button'][] = [
//                            'name'=>$v['menu_name'],
//                            'type'=>$type,
//                            'key' =>$v['response_keyword']
//                        ];
//                    }
//                }
//            }else{
//                switch ($value['event_type'])
//                {
//                    case 1:
//                        $type='view';
//                        break;
//                    case 2:
//                        $type='click';
//                        break;
//                    case 3:
//                        $type='scancode_push';
//                        break;
//                    case 4:
//                        $type='scancode_waitmsg';
//                        break;
//                    case 5:
//                        $type='pic_sysphoto';
//                        break;
//                    case 6:
//                        $type='pic_photo_or_album';
//                        break;
//                    case 7:
//                        $type='pic_weixin';
//                        break;
//                    case 8:
//                        $type='location_select';
//                        break;
//                }
//                $data['button'][$key]['name'] = $value['menu_name'];
//                $data['button'][$key]['type'] = $type;
//                if($value['event_type'] == 1){
//                    $data['button'][$key]['url']= $value['response_url'];
//                }else{
//                    $data['button'][$key]['key']= $value['response_keyword'];
//                }
//            }
//
//        }
//        $data['matchrule'] = [
//            'tag_id'=>'2'
//        ];


//       $menu_data_test = [
//           'button'=>[
//                   [
//                      'name'=>'菜单1',
//                       'sub_button'=>[
//                           [
//                               'type'=>'click',
//                               'name'=>'点击事件',
//                               'key'=>'1234',
//                           ],
//                           [
//                               'type'=>'view',
//                               'name'=>'链接事件',
//                               'url'=>'http://www.01nnt.com',
//                           ],
//                       ]
//                   ],
//           ],
//           'matchrule'=>[
//               "tag_id"               =>"2",
//                "sex"                 =>"1",
//                "country"             =>"中国",
//                "province"            =>"广东",
//                "city"                =>"广州",
//                "client_platform_type"=>"2",
//                "language"            =>"zh_CN"
//           ]
//       ];
//
//        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
//
//        $re = \Wechat::create_conditional_menu($auth_info['authorizer_access_token'],$menu_data_test);
//        dump($re);


//        $organization_id = $admin_data['organization_id'];
//        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
//        $re = \Wechat::search_menu($auth_info['authorizer_access_token']);
//
//        dump($re);

        return view('Fansmanage/Wechatmenu/conditional_menu',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
   }

    //自定义菜单添加页面
    public function conditional_menu_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $label_list = Label::ListLabel(['fansmanage_id'=>$admin_data['organization_id']]);
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        //获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]);
        //获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']]],0,'id','DESC');

        return view('Fansmanage/Wechatmenu/conditional_menu_add',['label_list'=>$label_list,'wechatreply'=>$wechatreply]);
    }

    //显示上级菜单
    public function conditional_menu_list(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数

        $tag_id = $request->label_id;//会员标签id
        if(empty($tag_id)){
            $list = [];
        }else{
            //获取授权APPID
            $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]);
            //获取菜单列表
            $list = WechatConditionalMenu::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']],['parent_id','0'],['tag_id',$tag_id]],0,'id','DESC');
        }
        return view('Fansmanage/Wechatmenu/conditional_menu_list',['list'=>$list]);
    }

    //添加自定义菜单检测
    public function conditional_menu_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $event_type = $request->get('event_type');  //获取事件类型
        $response_type = $request->get('response_type'); //获取响应类型
        $organization_id = $admin_data['organization_id'];  //组织ID
        $tag_id = $request->label_id;  //会员标签id
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]); //获取授权APPID
        $menu_name = $request->get('menu_name');                //获取菜单名称
        $parent_id = $request->get('parent_id');                //获取上级菜单ID
        if ($parent_id == 0){
            $parent_tree = '0,';
        }else{
            $parent_tree = '0,'.$parent_id.',';
        }
        $response_url = $request->get('response_url');          //获取响应网址
        $response_keyword = $request->get('response_keyword');  //获取响应关键字
        $defined_menu = [
            'organization_id' => $organization_id,
            'authorizer_appid' => $authorization['authorizer_appid'],
            'tag_id' => $tag_id,
            'menu_name' => $menu_name,
            'parent_id' => $parent_id,
            'parent_tree' => $parent_tree,
            'event_type' => $event_type,
            'response_type' => $response_type,
            'response_url' => $response_url,
            'response_keyword' => $response_keyword,
        ];

        $count = WechatConditionalMenu::getCount([['organization_id',$admin_data['organization_id']],['parent_id',$parent_id]]);
        if($parent_id == '0' && $count >= 3){
            return response()->json(['data' => '主菜单最多只能添加三条', 'status' => '0']);
        }
        if($parent_id <> '0' && $count >= 5){
            return response()->json(['data' => '子菜单只能添加5条', 'status' => '0']);
        }

        DB::beginTransaction();
        try {
            WechatConditionalMenu::addConditionalMenu($defined_menu);
            //添加操作日志
            if ($admin_data['is_super'] != 2){
                OperationLog::addOperationLog('3',$admin_data['organization_id'],$admin_data['id'],$route_name, '添加了公众号自定义菜单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '添加自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加自定义菜单成功！', 'status' => '1']);
    }

    public function conditional_menu_get(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $tag_id = $request->label_id;//会员标签id
        //获取菜单列表
        $list = WechatConditionalMenu::getList([['organization_id',$admin_data['organization_id']],['tag_id',$tag_id],['parent_id','0']],0,'id','asc');
        $son_menu = [];
        foreach ($list as $key=>$val){
            $sm = WechatConditionalMenu::getList([['organization_id',$admin_data['organization_id']],['tag_id',$tag_id],['parent_id',$val->id]],0,'id','asc');
            if(!empty($sm)){
                $son_menu[$val->id] = $sm;
            }
            unset($sm);
        }
        return view('Fansmanage/Wechatmenu/conditional_menu_get',['list'=>$list,'son_menu'=>$son_menu]);
    }

    //个性化菜单编辑页面
    public function conditional_menu_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->get('id');
        $conditionalmenu = WechatConditionalMenu::getOne([['id',$id]]);

        $label_name = Label::getPluck([['id',$conditionalmenu['tag_id']]],'label_name')->first();
        //获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]);
        //获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']]],0,'id','DESC');
        //获取菜单列表
        $list = WechatConditionalMenu::getList([['organization_id',$admin_data['organization_id']],['authorizer_appid',$authorization['authorizer_appid']],['parent_id','0'],['tag_id',$conditionalmenu['tag_id']],['id','<>',$conditionalmenu['id']]],0,'id','DESC');
        return view('Fansmanage/Wechatmenu/conditional_menu_edit',['list'=>$list,'wechatreply'=>$wechatreply,'conditionalmenu'=>$conditionalmenu,'label_name'=>$label_name]);
    }

    //编辑个性化菜单检测
    public function conditional_menu_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $event_type = $request->get('event_type');  //获取事件类型
        $menu_id = $request->get('menu_id');    //菜单ID
        $organization_id = $admin_data['organization_id'];  //组织ID
        $authorization = WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]]); //获取授权APPID
        $menu_name = $request->get('menu_name');                //获取菜单名称
        $parent_id = $request->get('parent_id');                //获取上级菜单ID

        $data =WechatConditionalMenu::getOne([['id',$menu_id]]);//获取菜单的信息
        $ziparent_tree = $data['parent_tree'].$data['id'].',';
        dd($ziparent_tree);

        $re = WechatConditionalMenu::checkRowExists([['organization_id',$admin_data['organization_id'],['tag_id',$data['tag_id']],['parent_tree',$ziparent_tree]]]);
        if($re){
            return response()->json(['data' => '菜单下面还有别的子菜单，不能更改', 'status' => '0']);
        }
        if($data['$parent_id'] !=$parent_id){//如果id有改变
            $count = WechatConditionalMenu::getCount([['organization_id',$admin_data['organization_id']],['parent_id',$parent_id],['tag_id',$data['tag_id']]]);
            if($parent_id == '0' && $count >= 3){
                return response()->json(['data' => '主菜单最多只能添加三条', 'status' => '0']);
            }
            if($parent_id <> '0' && $count >= 5){
                return response()->json(['data' => '子菜单只能添加5条', 'status' => '0']);
            }
        }

        if ($parent_id == 0){
            $parent_tree = '0,';
        }else{
            $parent_tree = '0,'.$parent_id.',';
        }
        $response_url = $request->get('response_url');          //获取响应网址
        $response_keyword = $request->get('response_keyword');  //获取响应关键字
        $response_type = $request->get('response_type'); //获取响应类型
        $defined_menu = [
            'organization_id' => $organization_id,
            'authorizer_appid' => $authorization['authorizer_appid'],
            'menu_name' => $menu_name,
            'parent_id' => $parent_id,
            'parent_tree' => $parent_tree,
            'event_type' => $event_type,
            'response_type' => $response_type,
            'response_url' => $response_url,
            'response_keyword' => $response_keyword,
        ];

        DB::beginTransaction();
        try {
            WechatDefinedMenu::editDefinedMenu(['id'=>$menu_id],$defined_menu);
            //添加操作日志
            if ($admin_data['is_super'] != 1){//超级管理员操作商户的记录
                OperationLog::addOperationLog('4',$admin_data['organization_id'],$admin_data['id'],$route_name, '修改了公众号自定义菜单！');//保存操作记录
            }
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自定义菜单成功！', 'status' => '1']);
    }















    public function test(){
       $auth_info = \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌

       /*获取授权方公众号信息*/
        //$info = WechatAuthorization::getOne([['organization_id',2]]);
        //\Wechat::get_authorizer_info($info->authorizer_appid);

        /*获取授权公众号的粉丝信息*/
        /*
        $fans_list = \Wechat::get_fans_list($auth_info['authorizer_access_token']);
        dump($fans_list);
        foreach($fans_list['data']['openid'] as $key=>$val){
            \Wechat::get_fans_info($auth_info['authorizer_access_token'],$val);
            exit();
        };
        */
        /******测试发送客服消息******/
        //$to_user = 'oyhbt1I_Gpz3u8JYxWP_NIugQhaQ';
        //$text = '你好世界';
        //\Wechat::send_fans_text($auth_info['authorizer_access_token'],$to_user,$text);

        /***网页授权测试***/
        $redirect_url = 'http://o2o.01nnt.com/api/wechat/web_redirect';
        $url = \Wechat::get_web_auth_url($redirect_url);
        echo "<script>location.href='".$url."'</script>";
        exit();



        //$auth_info =  \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌
        /***测试创建自定义菜单****/
        /*
        $menu_data_test = [
            'button'=>[
                    [
                       'name'=>'菜单1',
                        'sub_button'=>[
                            [
                                'type'=>'click',
                                'name'=>'点击事件',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'view',
                                'name'=>'链接事件',
                                'url'=>'http://www.01nnt.com',
                            ],
                        ]
                    ],
                    [
                        'name'=>'菜单2',
                        'sub_button'=>[
                            [
                                'type'=>'scancode_waitmsg',
                                'name'=>'扫码提示',
                                'key'=>'1234',
                            ],

                            [
                                'type'=>'pic_sysphoto',
                                'name'=>'系统拍照',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'pic_photo_or_album',
                                'name'=>'拍照相册',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'pic_weixin',
                                'name'=>'微信相册',
                                'key'=>'1234',
                            ]
                        ]

                    ],
                    [
                        'name'=>'菜单3',
                        'sub_button'=>[
                            [
                                'type'=>'location_select',
                                'name'=>'发送位置',
                                'key'=>'1234',
                            ],
                            [
                                'type'=>'scancode_push',
                                'name'=>'扫码事件',
                                'key'=>'1234',
                            ],
                        ]
                    ],
            ],
        ];
        $re = \Wechat::create_menu($auth_info['authorizer_access_token'],$menu_data_test);
        dump($re);
        */

        /***测试创建自定义菜单****/
        /*
        $re = \Wechat::search_menu($auth_info['authorizer_access_token']);
        dump($re);
        */

        /***测试删除自定义菜单****/
        /*
        $re = \Wechat::delete_menu($auth_info['authorizer_access_token']);
        dump($re);
        */

        /***测试创建用户标签***/
        /*
        $re = \Wechat::create_fans_tag($auth_info['authorizer_access_token'],'测试标签');
        dump($re);
        */
    }


}
?>