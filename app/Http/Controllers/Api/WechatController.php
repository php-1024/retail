<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\WechatReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WechatOpenSetting;
use App\Models\WechatImage;
use App\Models\WechatArticle;
use App\Models\WechatAuthorization;
use App\Models\WechatAuthorizerInfo;
use App\Models\Organization;
use App\Models\OperationLog;

class WechatController extends Controller{
    /*
     * 店铺授权
     */
    public function store_auth(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $url = "";
        if(WechatAuthorization::getOne([['organization_id',$admin_data['organization_id']]])){
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

        return view('Wechat/Catering/store_auth',['url'=>$url,'wechat_info'=>$wechat_info,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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
        return view('Wechat/Catering/material_image',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 图片素材上传
     */
    public function meterial_image_upload(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/material_image_upload',['admin_data'=>$admin_data,'route_name'=>$route_name]);
    }

    /*
     * 图片上传检测
     */
    public function meterial_image_upload_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $file = $request->file('image');
        if(!in_array( strtolower($file->getClientOriginalExtension()),['jpeg','jpg','gif','gpeg','png'])){
            return response()->json(['status' => '0','data'=>'错误的图片格式']);
        }
        if ($file->isValid()) {
            //检验文件是否有效
            $new_name = date('Ymdhis') . mt_rand(100, 999) . '.' . $file->getClientOriginalExtension();  //重命名
            $path = $file->move(base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/', $new_name);   //$path上传后的文件路径
            $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌
            $re = \Wechat::uploadimg($auth_info['authorizer_access_token'],base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name);
            if(!empty($re['media_id'])) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'filename' => $new_name,
                    'filepath' => base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name,
                    'media_id' => $re['media_id'],
                    'wechat_url' => $re['url']
                ];
                WechatImage::addWechatImage($data);
            }else{
                @unlink(base_path() . '/uploads/wechat/'.$admin_data['organization_id'].'/'.$new_name);
            }
            return response()->json(['data' => '上传商品图片信息成功', 'status' => '1']);
        } else {
            return response()->json(['data'=>'上传图片失败','status' => '0']);
        }
    }
    /*
     * 删除图片
     *
     */
    //直接输入安全密码操作的页面--删除
    public function material_image_delete_comfirm(Request $request){
        $id = $request->input('id');
        return view('Wechat/Catering/material_image_delete_comfirm',['id'=>$id]);
    }
    public function material_image_delete_check(Request $request){
        $id = $request->input('id');
        $image_info = WechatImage::getOne([['id',$id]]);
        $auth_info = \Wechat::refresh_authorization_info($image_info['organization_id']);//刷新并获取授权令牌

        $re = \Wechat::delete_meterial($auth_info['authorizer_access_token'],$image_info['media_id']);
        if($re['errcode']=='0'){
            @unlink($image_info['filepath']);
            WechatImage::where('id',$id)->forceDelete();
            return response()->json(['data'=>'删除图片素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'删除图片素材失败','status' => '0']);
        }
    }

    /*
     * 图文素材列表
     */
    public function material_article(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = WechatArticle::getPaginage([['organization_id',$admin_data['organization_id']]],15,'id',$sort='DESC');
        return view('Wechat/Catering/material_article',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 添加单条图文素材页面
     */
    public function material_article_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/material_article_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     *单条图文素材添加检测
     */
    public function material_article_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $thumb_media_id = $request->input('thumb_media_id');
        $title = $request->input('title');
        $author = $request->input('author');
        $digest = $request->input('digest');
        $origin_url = $request->input('origin_url');
        $content = $request->input('content');

        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌

        $data = [
            'articles'=>[
                [
                    'title'=>$title,
                    'thumb_media_id'=>$thumb_media_id,
                    'author'=>$author,
                    'digest'=>$digest,
                    'show_cover_pic'=>1,
                    'content'=>$content,
                    'content_source_url'=>$origin_url
                ],
            ],
        ];

        $re = \Wechat::upload_article($auth_info['authorizer_access_token'],$data);
        if(!empty($re['media_id'])){
            $zdata = [
                'organization_id'=>$admin_data['organization_id'],
                'title'=>$title,
                'media_id'=>$re['media_id'],
                'type'=>'1',
                'content'=>serialize($data),
            ];
            WechatArticle::addWechatArticle($zdata);
            return response()->json(['data'=>'上传图文素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'上传图文素材失败','status' => '0']);
        }
    }


    /*
     * 添加多条图文素材页面
     */
    public function material_articles_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/material_articles_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     *检测添加多条图文
     */
    public function material_articles_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $num = $request->get('num');
        $data['articles'] = [];
        for($i=1;$i<=$num;$i++){
            array_push($data['articles'],[
                'title'=>$request->get('title_'.$i),
                'thumb_media_id'=>$request->get('thumb_media_id_'.$i),
                'author'=>$request->get('author_'.$i),
                'digest'=>'',
                'show_cover_pic'=>1,
                'content'=>$request->get('content_'.$i),
                'content_source_url'=>$request->get('origin_url_'.$i),
            ]);
        }
        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌
        $re = \Wechat::upload_article($auth_info['authorizer_access_token'],$data);
        if(!empty($re['media_id'])){
            $zdata = [
                'organization_id'=>$admin_data['organization_id'],
                'title'=>$request->get('title_1'),
                'media_id'=>$re['media_id'],
                'type'=>'2',
                'content'=>serialize($data),
            ];
            WechatArticle::addWechatArticle($zdata);
            return response()->json(['data'=>'上传图文素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'上传图文素材失败','status' => '0']);
        }
    }

    /*
   * 删除图文
   *
   */
    //直接输入安全密码操作的页面--删除
    public function material_article_delete_comfirm(Request $request){
        $id = $request->input('id');
        return view('Wechat/Catering/material_article_delete_comfirm',['id'=>$id]);
    }
    public function material_article_delete_check(Request $request){
        $id = $request->input('id');
        $article_info = WechatArticle::getOne([['id',$id]]);
        $auth_info = \Wechat::refresh_authorization_info($article_info['organization_id']);//刷新并获取授权令牌
        $re = \Wechat::delete_meterial($auth_info['authorizer_access_token'],$article_info['media_id']);
        if($re['errcode']=='0'){
            WechatArticle::where('id',$id)->forceDelete();
            return response()->json(['data'=>'删除图文素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'删除图文素材失败','status' => '0']);
        }
    }

    /*
    * 编辑单条图文素材页面
    */
    public function material_article_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');

        /*
         * 获取文章数据
         */
        $article_info = WechatArticle::getOne([['id',$id]]);
        $article_info->content = unserialize($article_info->content);
        $article_info = $article_info->toArray();
        /*
         * 根据media_id查询相关图片数据
         */
        $image_info = WechatImage::getOne([['media_id',$article_info['content']['articles'][0]['thumb_media_id']]]);

        $info = $article_info['content']['articles'][0];
        return view('Wechat/Catering/material_article_edit',['info'=>$info,'id'=>$id,'image_info'=>$image_info,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    /*
     * 编辑单条图文数据提交
     */
    public function material_article_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        $id = $request->input('id');
        $thumb_media_id = $request->input('thumb_media_id');
        $title = $request->input('title');
        $author = $request->input('author');
        $digest = $request->input('digest');
        $origin_url = $request->input('origin_url');
        $content = $request->input('content');

        $article_info = WechatArticle::getOne([['id',$id]]);

        $auth_info = \Wechat::refresh_authorization_info($article_info['organization_id']);//刷新并获取授权令牌

        //提交到微信公众号的数据
        $data = [
            'articles'=>[
                    'title'=>$title,
                    'thumb_media_id'=>$thumb_media_id,
                    'author'=>$author,
                    'digest'=>$digest,
                    'show_cover_pic'=>1,
                    'content'=>$content,
                    'content_source_url'=>$origin_url
            ],
        ];
        //保存在零壹的数据
        $adata = [
            'articles'=>[
                [
                    'title'=>$title,
                    'thumb_media_id'=>$thumb_media_id,
                    'author'=>$author,
                    'digest'=>$digest,
                    'show_cover_pic'=>1,
                    'content'=>$content,
                    'content_source_url'=>$origin_url
                ],
            ],
        ];

        $re = \Wechat::update_meterial($auth_info['authorizer_access_token'],$article_info['media_id'],0,$data);

        if($re['errcode'] == '0'){
            $zdata = [
                'title'=>$title,
                'content'=>serialize($adata),
            ];
            WechatArticle::editWechatArticle([['id',$id]],$zdata);
            return response()->json(['data'=>'编辑图文素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'编辑图文素材失败','status' => '0']);
        }
    }

    /*
    * 编辑多条图文素材页面
    */
    public function material_articles_edit(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');

        /*
         * 获取文章数据
         */
        $article_info = WechatArticle::getOne([['id',$id]]);
        $article_info['content'] = unserialize( $article_info['content'] );
        $article_info = $article_info->toArray();
        $articles = $article_info['content']['articles'];

        foreach($articles as $key=>$val){
            $image_info = WechatImage::getOne([['media_id',$val['thumb_media_id']]])->toArray();
            $articles[$key]['image_info'] = $image_info;
            unset($image_info);
        }
        $num = count($articles);

        return view('Wechat/Catering/material_articles_edit',['id'=>$id,'num'=>$num,'articles'=>$articles,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 编辑多条图文数据提交
     */
    public function material_articles_edit_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');

        $num = $request->get('num');
        $adata['articles'] = [];
        $flag = true;

        $article_info = WechatArticle::getOne([['id',$id]]);
        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);//刷新并获取授权令牌

        for($i=1;$i<=$num;$i++){
            array_push($adata['articles'],[
                'title'=>$request->get('title_'.$i),
                'thumb_media_id'=>$request->get('thumb_media_id_'.$i),
                'author'=>$request->get('author_'.$i),
                'digest'=>'',
                'show_cover_pic'=>1,
                'content'=>$request->get('content_'.$i),
                'content_source_url'=>$request->get('origin_url_'.$i),
            ]);

            $data['articles'] = [
                'title'=>$request->get('title_'.$i),
                'thumb_media_id'=>$request->get('thumb_media_id_'.$i),
                'author'=>$request->get('author_'.$i),
                'digest'=>'',
                'show_cover_pic'=>1,
                'content'=>$request->get('content_'.$i),
                'content_source_url'=>$request->get('origin_url_'.$i),
            ];

            $re = \Wechat::update_meterial($auth_info['authorizer_access_token'],$article_info['media_id'],$i-1,$data);
            if($re['errcode'] <> '0'){
                $flag = false;
            }
        }

        if($flag){
            $zdata = [
                'title'=>$request->get('title_1'),
                'content'=>serialize($adata),
            ];
            WechatArticle::editWechatArticle([['id',$id]],$zdata);
            return response()->json(['data'=>'编辑图文素材成功','status' => '1']);
        }else{
            return response()->json(['data'=>'编辑图文素材失败','status' => '0']);
        }

    }
    /*
     * 图片选择页面
     */
    public function material_image_select(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $i = $request->input('i');
        $list = WechatImage::getList([['organization_id',$admin_data['organization_id']]],'','id','desc');
        return view('Wechat/Catering/material_image_select',['list'=>$list,'i'=>$i]);
    }
    /**************************************************************************图文素材结束*********************************************************************************/

    /**************************************************************************自定义菜单，个性化菜单开始*********************************************************************************/
    public function defined_menu(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/defined_menu',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    public function defined_menu_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/defined_menu_add');
    }
    public function defined_menu_get(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        return view('Wechat/Catering/defined_menu_get');
    }
    /**************************************************************************自定义菜单，个性化菜单结束*********************************************************************************/


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
    /**************************************************************************消息回复管理开始*********************************************************************************/
    /*
     * 关键字自动回复列表
     */
    public function auto_reply(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $list = WechatReply::getPaginage([['organization_id',$admin_data['organization_id']]],15,'id','desc');
        return view('Wechat/Catering/auto_reply',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    /*
     * 添加关键字
     */
    public function auto_reply_add(Request $request){
        return view('Wechat/Catering/auto_reply_add');
    }

    /*
     * 添加关键字数据
     */
    public function auto_reply_add_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $keyword = $request->input('keyword');//关键字
        $type = $request->input('type');//1-精确 2-模糊
        $organization_id = $admin_data['organization_id'];//角色权限节点
        $appinfo = WechatAuthorization::getOne([['organization_id',$organization_id]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        if(WechatReply::checkRowExists([['organization_id',$organization_id],['keyword',$keyword]])){//判断是否添加过相同的的角色
            return response()->json(['data' => '您添加的关键字已经存在', 'status' => '0']);
        }else {
            DB::beginTransaction();
            try {
                $data = ['organization_id'=>$organization_id,'authorizer_appid'=>$authorizer_appid,'keyword'=>$keyword,'type'=>$type];
                WechatReply::addWechatReply($data);
                OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'添加了自动回复关键字'.$keyword);//保存操作记录
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();//事件回滚
                return response()->json(['data' => '添加关键字失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '添加关键字成功', 'status' => '1']);
        }
    }

    /*
    * 添加关键字文本回复
    */
    public function auto_reply_edit_text(Request $request){
        $id = $request->input('id');
        $info = WechatReply::getOne([['id',$id]]);
        return view('Wechat/Catering/auto_reply_edit_text',['id'=>$id,'info'=>$info]);
    }

    /*
     * 编辑自动回复文本内容
     */
    public function auto_reply_edit_text_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $reply_type = 1;
        $reply_info = $request->input('reply_info');
        $info = WechatReply::getOne([['id',$id]]);

        DB::beginTransaction();
        try {
            $data = ['reply_type'=>$reply_type,'reply_info'=>$reply_info,'media_id'=>''];
            WechatReply::editWechatReply([['id',$id]],$data);
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了自动回复关键字'.$info['keyword'].'的文本回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自动回复关键字的文本回复失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自动回复关键字的文本回复成功', 'status' => '1']);
    }

    /*
   * 关键字自动回复回复图片内容
   */
    public function auto_reply_edit_image(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');
        $info = WechatReply::getOne([['id',$id]]);
        $list = WechatImage::getList([['organization_id',$admin_data['organization_id']]],'','id','desc');
        return view('Wechat/Catering/auto_reply_edit_image',['id'=>$id,'info'=>$info,'list'=>$list]);
    }
    /*
    * 编辑自动回复文本内容
    */
    public function auto_reply_edit_image_check(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $image_id = $request->input('image_id');
        $image_info = WechatImage::getOne([['id',$image_id]]);

        $media_id = $image_info['media_id'];
        $reply_info = asset('uploads/wechat/'.$admin_data['organization_id'].'/'.$image_info['filename']);

        $reply_type = 2;
        $info = WechatReply::getOne([['id',$id]]);

        DB::beginTransaction();
        try {
            $data = ['reply_type'=>$reply_type,'reply_info'=>$reply_info,'media_id'=>$media_id];
            WechatReply::editWechatReply([['id',$id]],$data);
            OperationLog::addOperationLog('1',$admin_data['organization_id'],$admin_data['id'],$route_name,'修改了自动回复关键字'.$info['keyword'].'的文本回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自动回复关键字的文本回复失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自动回复关键字的文本回复成功', 'status' => '1']);
    }



    public function subscribe_reply(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/auto_reply',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    public function default_reply(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Wechat/Catering/auto_reply',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }
    /**************************************************************************消息回复管理结束*********************************************************************************/

    /**************************************************************************接收推送消息及回复开始*********************************************************************************/
    /*
     * 网页授权链接回调函数
     */
    public function web_redirect(){
        $code = trim($_GET['code']);
        $state = trim($_GET['state']);
        if($state == 'lyxkj2018'){
            $re = \Wechat::get_web_access_token($code);
            $appid = 'wxab6d2b312939eb01';
            $redirect_url = 'http://o2o.01nnt.com/api/wechat/open_web_redirect?param='.$appid.'||'.$re['openid'];
            $url = \Wechat::get_open_web_auth_url($appid,$redirect_url);
            echo "<script>location.href='".$url."'</script>";
            exit();
        }else{
            exit('无效的的回调链接');
        }
    }

    /*
     * 开放平台代网页授权链接回调函数
     */
    public function open_web_redirect(){
        $code = trim($_GET['code']);
        $state = trim($_GET['state']);
        $param = $_GET['param'];
        $param_arr = explode('||',$param);
        $appid = $param_arr[0];
        $open_id = $param_arr[1];
        $auth_info = \Wechat::refresh_authorization_info(1);//刷新并获取授权令牌
        if($state == 'lyxkj2018'){
            $re = \Wechat::get_open_web_access_token($appid,$code);
            dump($open_id);
            dump($re);
            $info = \Wechat::get_fans_info($auth_info['authorizer_access_token'],$open_id);
            dump($info);
            exit();
        }else{
            exit('无效的的回调链接');
        }
    }

    /*
     * 开放平台回复函数
     */
    public function response($appid,Request $request){
        $timestamp = empty($_GET['timestamp']) ? '' : trim($_GET['timestamp']);
        $nonce = empty($_GET['nonce']) ? '' : trim($_GET ['nonce']);
        $msgSign = empty($_GET['msg_signature']) ? '' : trim($_GET['msg_signature']);
        $signature = empty($_GET['signature']) ? '' : trim($_GET['signature']);
        $encryptType = empty($_GET['encrypt_type']) ? '' : trim($_GET['encrypt_type']);
        $openid = $appid;
        $input = file_get_contents('php://input');
        file_put_contents('test.txt',$input);
        $paramArr = $this->xml2array($input);

        $jm = \Wechat::WXBizMsgCrypt();
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $fromXml = sprintf($format, $paramArr['Encrypt']);
        $toXml='';
        $errCode = $jm->decryptMsg($msgSign, $timestamp, $nonce, $fromXml, $toXml); // 解密
        file_put_contents('test2.txt',$toXml);
        if($errCode == '0'){
            $param = $this->xml2array($toXml);
            $keyword = isset($param['Content']) ? trim($param['Content']) : '';
            // 案例1 - 发送事件
            if (isset($param['Event']) && $paramArr['ToUserName'] == 'gh_3c884a361561') {
                $contentStr = $param ['Event'] . 'from_callback';
            }
            // 案例2 - 返回普通文本
            elseif ($keyword == "TESTCOMPONENT_MSG_TYPE_TEXT") {
                $contentStr = "TESTCOMPONENT_MSG_TYPE_TEXT_callback";
            }
            // 案例3 - 返回Api文本信息
            elseif (strpos($keyword, "QUERY_AUTH_CODE:") !== false) {
                $authcode = str_replace("QUERY_AUTH_CODE:", "", $keyword);
                $contentStr = $authcode . "_from_api";
                $auth_info = \Wechat::get_authorization_info($authcode);
                $accessToken = $auth_info['authorizer_access_token'];
                \Wechat::send_fans_text($accessToken, $param['FromUserName'], $contentStr);
                return 1;
            }else{
               return $this->zerone_response($jm,$param,$appid,$_GET['encrypt_type'],$_GET['timestamp'],$_GET['nonce']);
            }
            //点击事件触发关键字回复
            /*
            elseif ($param['EventKey'] == "1234") {
                $contentStr = $openid.'||'.$param['FromUserName'].'||'.$param['ToUserName']."||测试内容2";
            }
            */
            $result = '';
            if (!empty($contentStr)) {
                $xmlTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
                $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $contentStr);
                if (isset($_GET['encrypt_type']) && $_GET['encrypt_type'] == 'aes') { // 密文传输
                    $encryptMsg = '';
                    $jm->encryptMsg($result, $_GET['timestamp'], $_GET['nonce'], $encryptMsg);
                    $result = $encryptMsg;
                }
            }
            echo $result;
        }
    }

    /**
     * 除全网发布外零壹的回复
     * $jm - 微信加密类
     * $param - 来源内容
     * $appid - 哪个公众号内传过来的消息
     * $encrypt_type - 是否密文传输
     * $timestamp,$nonce - 加密消息要用的数据
     */
    private function zerone_response($jm,$param,$appid,$encrypt_type,$timestamp,$nonce){
        //$result = $this->zerone_response_text($param,'测试回复内容|'.$appid);
        //$result = $this->zerone_response_image($param,'bosoFPsCynb5D_7F_IPAPKd_FOPDaqpXw62tH8u_t8Q');
        //$result = $this->zerone_response_article($param,[['title'=>'今天礼拜天','description'=>'礼拜天人很少','picurl'=>'http://mmbiz.qpic.cn/mmbiz_jpg/Ft65fsDXhHpXW7QhsteXl5j1FX5ia9kCWwApHTWEfVrOibuZmSwaYhlxRS0ibPiccGv5lGGxSWCmnbBwuhVzCq0vvw/0?wx_fmt=jpeg','url'=>'http://o2o.01nnt.com']]);
        $result = $this->zerone_response_text($param,'欢迎光临');
        if (isset($encrypt_type) && $_GET['encrypt_type'] == 'aes') { // 密文传输
            $encryptMsg = '';
            $jm->encryptMsg($result, $timestamp, $nonce, $encryptMsg);
            $result = $encryptMsg;
        }
        return $result;
    }

    /*
     * 回复文本消息
     */
    private function zerone_response_text($param,$contentStr){
        $xmlTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            </xml>";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $contentStr);
        return $result;
    }
    /*
     * 回复图片消息
     */
    private function zerone_response_image($param,$media_id){
        $xmlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                <MediaId><![CDATA[%s]]></MediaId>
                </Image>
                </xml>";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'], time(), $media_id);
        return $result;
    }
    /*
     * 回复文本信息
     */
    private function zerone_response_article($param,$article_data){
        $xmlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>%s</ArticleCount>
                <Articles>";
        foreach($article_data as $key=>$val){
            $xmlTpl.="<item>
<Title><![CDATA[".$val['title']."]]></Title>
<Description><![CDATA[".$val['description']."]]></Description>
<PicUrl><![CDATA[".$val['picurl']."]]></PicUrl>
<Url><![CDATA[".$val['url']."]]></Url>
</item>";
        }
        $xmlTpl.="</Articles>
                </xml> ";
        $result = sprintf($xmlTpl, $param['FromUserName'], $param['ToUserName'],time(), count($article_data));
        return $result;
    }

    /*
     * XML转化为数组
     */
    public  function xml2array($xmlstring)
    {
        $object = simplexml_load_string($xmlstring, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        return @json_decode(@json_encode($object),1);
    }

    //接受收授权推送消息。
    public function open(Request $request){
        $timeStamp    =$_GET['timestamp'];
        $nonce        =$_GET['nonce'];
        $encrypt_type =$_GET['encrypt_type'];
        $msg_sign     =$_GET['msg_signature'];
        $encryptMsg   =file_get_contents('php://input');
        //file_put_contents('testopen.txt',$timeStamp.'|'.$nonce.'|'.$encrypt_type.'|'.$msg_sign.'|'.$encryptMsg);
        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }

    //授权回调链接
    public function redirect(Request $request){
        $zerone_param = $_GET['zerone_param'];//中间件产生的管理员数据参数
        $arr = explode('@@',$zerone_param);
        $organization_id = trim($arr[0]);
        $redirect_url = trim($arr[1]);
        $auth_code = $_GET['auth_code'];//授权码
        $auth_info = \Wechat::get_authorization_info($auth_code);//获取授权
        if(WechatAuthorization::checkRowExists($organization_id,$auth_info['authorizer_appid'])){
            return response()->json(['data' => '您的店铺已绑定公众号 或者 您的公众号已经授权到其他店铺', 'status' => '-1']);
        }else {
            $auth_data = array(
                'organization_id' => $organization_id,
                'authorizer_appid' => $auth_info['authorizer_appid'],
                'authorizer_access_token' => $auth_info['authorizer_access_token'],
                'authorizer_refresh_token' => $auth_info['authorizer_refresh_token'],
                'origin_data' => $auth_info['origin_re'],
                'status' => '1',
                'expire_time' => time() + 7200,
            );
            $id = WechatAuthorization::addAuthorization($auth_data);
            return view('Wechat/Catering/redirect',['organization_id'=>$organization_id,'id'=>$id,'redirect_url'=>$redirect_url]);
        }
    }

    /*
     * 从微信端拉取授权方公众号的基本信息 与 拉取它的所有粉丝 并保存到数据库
     */
    public function pull_authorizer_data(Request $request){
        $organization_id  = $request->input('organization_id');
        $id = $request->input('id');
        $auth_info = \Wechat::refresh_authorization_info($organization_id);//刷新并获取授权令牌
        $this->pull_authorizer_info($id,$auth_info,'');
        return response()->json(['data' => '拉取成功', 'status' => '1']);
    }

    /*
     * 拉取公众号的基本信息
     */
    private function pull_authorizer_info($id,$auth_info){
        $authorizer_data = \Wechat::get_authorizer_info($auth_info['authorizer_appid']);//获取对应公众号的详细信息
        $authorizer_info = $authorizer_data['authorizer_info'];
        $data = [
            'authorization_id'=>$id,
            'nickname'=>$authorizer_info['nick_name'],
            'head_img'=>$authorizer_info['head_img'],
            'service_type_info'=>serialize($authorizer_info['service_type_info']),
            'verify_type_info'=>serialize($authorizer_info['verify_type_info']),
            'user_name'=>$authorizer_info['user_name'],
            'principal_name'=>$authorizer_info['principal_name'],
            'alias'=>$authorizer_info['alias'],
            'business_info'=>serialize($authorizer_info['business_info']),
            'qrcode_url'=>$authorizer_info['qrcode_url'],
        ];
        WechatAuthorizerInfo::addAuthorizerInfo($data);
    }
    /**************************************************************************接收推送消息及回复结束*********************************************************************************/
}
?>