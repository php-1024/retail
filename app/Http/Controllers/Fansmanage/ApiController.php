<?php
namespace App\Http\Controllers\Fansmanage;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\WechatArticle;
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
        return view('Fansmanage/Api/material_image_upload',['admin_data'=>$admin_data,'route_name'=>$route_name]);
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
        return view('Fansmanage/Api/material_image_delete_comfirm',['id'=>$id]);
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
        return view('Fansmanage/Api/material_article',['list'=>$list,'admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
    }

    /*
     * 添加单条图文素材页面
     */
    public function material_article_add(Request $request){
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由

        return view('Fansmanage/Api/material_article_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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
        return view('Fansmanage/Api/material_articles_add',['admin_data'=>$admin_data,'route_name'=>$route_name,'menu_data'=>$menu_data,'son_menu_data'=>$son_menu_data]);
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



}
?>