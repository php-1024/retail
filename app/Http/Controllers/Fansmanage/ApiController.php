<?php
/**
 * 公众号管理 模块，包括：
 *   公众号授权信息，图文和图片素材上传
 */
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

class ApiController extends Controller
{
    // +----------------------------------------------------------------------
    // | Start - 公众号管理
    // +----------------------------------------------------------------------
    /**
     * 公众号管理
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store_auth(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        $url = "";
        // 判断是否能够在有保存该组织id 的公众号信息，如果没有就进行第三方凭条的获取授权地址
        if (!WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]])) {
            // 获取第三方平台授权地址，点击授权的地址
            $url = \Wechat::get_auth_url($admin_data['organization_id'], $route_name);
        }
        $wechat_info = [];
        // 获取组织信息
        $org_info = Organization::where('id', $admin_data['organization_id'])->first();
        // 如果该组织授权了公众号，存在微信公众号的授权信息
        if (isset($org_info->wechatAuthorization)) {
            // 获取公众号信息
            $wechat_info = $org_info->wechatAuthorization->wechatAuthorizerInfo;
            // 如果没有带参数的二维码
            if (empty($wechat_info['zerone_qrcode_url'])) {
                // 获取公众号带参数关注二维码

                // 刷新并获取授权令牌
                $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);
                // 创建临时二维码
                $imgre = \Wechat::createQrcode($auth_info['authorizer_access_token'], $admin_data['organization_id']);
                // 如果接口没有出错，就进行保存
                if ($imgre) {
                    // 更新二维码信息
                    WechatAuthorizerInfo::editAuthorizerInfo([['id', $org_info->wechatAuthorization->id]], ['zerone_qrcode_url' => $imgre]);
                    $wechat_info['zerone_qrcode_url'] = $imgre;
                }
            }
        }
        // 渲染页面
        return view('Fansmanage/Api/store_auth', ['url' => $url, 'wechat_info' => $wechat_info, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }
    // +----------------------------------------------------------------------
    // | End - 公众号管理
    // +----------------------------------------------------------------------

    // +----------------------------------------------------------------------
    // | Start - 图文素材
    // +----------------------------------------------------------------------
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_image(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 获取图文素材列表
        $list = WechatImage::getPaginage([['organization_id', $admin_data['organization_id']]], 30, 'id', $sort = 'DESC');
        // 渲染页面
        return view('Fansmanage/Api/material_image', ['list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 图片素材上传
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meterial_image_upload(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 渲染页面
        return view('Fansmanage/Api/material_image_upload', ['admin_data' => $admin_data, 'route_name' => $route_name]);
    }


    /**
     * 图片上传检测
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function meterial_image_upload_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取上传上来的图片信息
        $file = $request->file('image');
        // 判断图片的格式
        if (!in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'gif', 'gpeg', 'png'])) {
            // 不对就进行数据的返回
            return response()->json(['status' => '0', 'data' => '错误的图片格式']);
        }
        // 检测图片是否有效
        if ($file->isValid()) {
            // 重命名
            $new_name = date('Ymdhis') . mt_rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file_path = base_path() . '/uploads/wechat/' . $admin_data['organization_id'] . '/' . $new_name;

            // 将图片进行保存
            $file->move(base_path() . '/uploads/wechat/' . $admin_data['organization_id'] . '/', $new_name);

            // 刷新并获取授权令牌
            $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);
            // 上传永久图片素材
            $re = \Wechat::uploadimg($auth_info['authorizer_access_token'], $file_path);
            // 判断接口返回是否正确
            if (!empty($re['media_id'])) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'filename' => $new_name,
                    'filepath' => $file_path,
                    'media_id' => $re['media_id'],
                    'wechat_url' => $re['url']
                ];
                // 添加数据
                WechatImage::addWechatImage($data);
            } else {
                // 保存不成功就删除本地刚才保存的图片
                @unlink(base_path() . '/uploads/wechat/' . $admin_data['organization_id'] . '/' . $new_name);
            }
            // 返回提示
            return response()->json(['data' => '上传商品图片信息成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '上传图片失败', 'status' => '0']);
        }
    }

    /**
     * 删除图片页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_image_delete_comfirm(Request $request)
    {
        $id = $request->input('id');
        // 渲染页面
        return view('Fansmanage/Api/material_image_delete_comfirm', ['id' => $id]);
    }

    /**
     * 删除图片检测
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function material_image_delete_check(Request $request)
    {
        // 获取图片的保存id
        $id = $request->input('id');
        // 获取图片数据
        $image_info = WechatImage::getOne([['id', $id]]);
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($image_info['organization_id']);
        // 删除素材
        $re = \Wechat::delete_meterial($auth_info['authorizer_access_token'], $image_info['media_id']);
        // 判断接口是否返回正确
        if ($re['errcode'] == '0') {
            // 删除图片文件
            @unlink($image_info['filepath']);
            // 将图片进行强制删除
            WechatImage::where('id', $id)->forceDelete();
            // 返回提示
            return response()->json(['data' => '删除图片素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '删除图片素材失败', 'status' => '0']);
        }
    }

    /**
     * 图文素材列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_article(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 获取图片素材列表
        $list = WechatArticle::getPaginage([['organization_id', $admin_data['organization_id']]], 15, 'id', $sort = 'DESC');
        // 渲染页面
        return view('Fansmanage/Api/material_article', ['list' => $list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 添加单条图文素材页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_article_add(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 渲染页面
        return view('Fansmanage/Api/material_article_add', ['admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 单条图文素材添加检测
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse、
     */
    public function material_article_add_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');

        // 缩略图的保存id
        $thumb_media_id = $request->input('thumb_media_id');
        // 标题
        $title = $request->input('title');
        // 作者
        $author = $request->input('author');
        // 摘要
        $digest = $request->input('digest');
        // 原文地址
        $origin_url = $request->input('origin_url');
        // 正文
        $content = $request->input('content');
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);
        // 处理数据结构
        $data = [
            'articles' => [
                [
                    'title' => $title,
                    'thumb_media_id' => $thumb_media_id,
                    'author' => $author,
                    'digest' => $digest,
                    'show_cover_pic' => 1,
                    'content' => $content,
                    'content_source_url' => $origin_url
                ],
            ],
        ];
        // 上传图片素材到微信
        $re = \Wechat::upload_article($auth_info['authorizer_access_token'], $data);
        // 判断是否上传成功
        if (!empty($re['media_id'])) {
            $zdata = [
                'organization_id' => $admin_data['organization_id'],
                'title' => $title,
                'media_id' => $re['media_id'],
                'type' => '1',
                'content' => serialize($data),
            ];
            // 添加数据
            WechatArticle::addWechatArticle($zdata);
            return response()->json(['data' => '上传图文素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '上传图文素材失败', 'status' => '0']);
        }
    }

    /**
     * 添加多条图文素材页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_articles_add(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 渲染页面
        return view('Fansmanage/Api/material_articles_add', ['admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 检测添加多条图文
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function material_articles_add_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取添加的数目
        $num = $request->get('num');
        $data['articles'] = [];
        // 处理数据
        for ($i = 1; $i <= $num; $i++) {
            array_push($data['articles'], [
                'title' => $request->get('title_' . $i),
                'thumb_media_id' => $request->get('thumb_media_id_' . $i),
                'author' => $request->get('author_' . $i),
                'digest' => '',
                'show_cover_pic' => 1,
                'content' => $request->get('content_' . $i),
                'content_source_url' => $request->get('origin_url_' . $i),
            ]);
        }
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);
        // 上传图文信息
        $re = \Wechat::upload_article($auth_info['authorizer_access_token'], $data);
        if (!empty($re['media_id'])) {
            $zdata = [
                'organization_id' => $admin_data['organization_id'],
                'title' => $request->get('title_1'),
                'media_id' => $re['media_id'],
                'type' => '2',
                'content' => serialize($data),
            ];
            // 添加数据
            WechatArticle::addWechatArticle($zdata);
            // 返回提示
            return response()->json(['data' => '上传图文素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '上传图文素材失败', 'status' => '0']);
        }
    }


    /**
     * 删除图文
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_article_delete_comfirm(Request $request)
    {
        $id = $request->input('id');
        // 渲染页面
        return view('Fansmanage/Api/material_article_delete_comfirm', ['id' => $id]);
    }

    /**
     * 检测删除数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function material_article_delete_check(Request $request)
    {
        // 获取要删除的数据id
        $id = $request->input('id');
        // 获取图文数据
        $article_info = WechatArticle::getOne([['id', $id]]);
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($article_info['organization_id']);
        // 删除微信公众号上面的素材
        $re = \Wechat::delete_meterial($auth_info['authorizer_access_token'], $article_info['media_id']);
        // 判断接口是否出错
        if ($re['errcode'] == '0') {
            // 强制删除数据
            WechatArticle::where('id', $id)->forceDelete();
            // 返回提示
            return response()->json(['data' => '删除图文素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '删除图文素材失败', 'status' => '0']);
        }
    }

    /**
     * 编辑单条图文素材页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_article_edit(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 获取要编辑的图文的id
        $id = $request->input('id');
        // 获取文章数据
        $article_info = WechatArticle::getOne([['id', $id]]);
        // 获取正文
        $article_info->content = unserialize($article_info->content);
        $article_info = $article_info->toArray();
        // 根据media_id查询相关图片数据
        $image_info = WechatImage::getOne([['media_id', $article_info['content']['articles'][0]['thumb_media_id']]]);
        // 获取图片信息
        $info = $article_info['content']['articles'][0];
        // 渲染页面
        return view('Fansmanage/Api/material_article_edit', ['info' => $info, 'id' => $id, 'image_info' => $image_info, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 编辑单条图文数据提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function material_article_edit_check(Request $request)
    {
        $id = $request->input('id');
        // 缩略图的保存id
        $thumb_media_id = $request->input('thumb_media_id');
        // 标题
        $title = $request->input('title');
        // 作者
        $author = $request->input('author');
        // 摘要
        $digest = $request->input('digest');
        // 原文地址
        $origin_url = $request->input('origin_url');
        // 正文
        $content = $request->input('content');
        // 获取图文数据
        $article_info = WechatArticle::getOne([['id', $id]]);
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($article_info['organization_id']);

        // 处理数据
        $data = [
            'articles' => [
                'title' => $title,
                'thumb_media_id' => $thumb_media_id,
                'author' => $author,
                'digest' => $digest,
                'show_cover_pic' => 1,
                'content' => $content,
                'content_source_url' => $origin_url
            ],
        ];
        // 数据处理
        $adata = [
            'articles' => [
                [
                    'title' => $title,
                    'thumb_media_id' => $thumb_media_id,
                    'author' => $author,
                    'digest' => $digest,
                    'show_cover_pic' => 1,
                    'content' => $content,
                    'content_source_url' => $origin_url
                ],
            ],
        ];
        // 提交到微信公众号的数据
        $re = \Wechat::update_meterial($auth_info['authorizer_access_token'], $article_info['media_id'], 0, $data);
        // 判断接口是否出错
        if ($re['errcode'] == '0') {
            $zdata = [
                'title' => $title,
                'content' => serialize($adata),
            ];
            // 编辑图文数据
            WechatArticle::editWechatArticle([['id', $id]], $zdata);
            // 返回提示
            return response()->json(['data' => '编辑图文素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '编辑图文素材失败', 'status' => '0']);
        }
    }

    /**
     * 编辑多条图文素材页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_articles_edit(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        $id = $request->input('id');
        // 获取文章数据
        $article_info = WechatArticle::getOne([['id', $id]]);
        // 将解字符串化的数据
        $article_info['content'] = unserialize($article_info['content']);
        $article_info = $article_info->toArray();
        // 获取实体内容
        $articles = $article_info['content']['articles'];
        // 遍历数据
        foreach ($articles as $key => $val) {
            $image_info = [];
            // 获取图文中的图片信息
            $image_info = WechatImage::getOne([['media_id', $val['thumb_media_id']]])->toArray();
            // 处理数据
            $articles[$key]['image_info'] = $image_info;
            // 初始化数据
            unset($image_info);
        }
        // 获取图文的数量
        $num = count($articles);
        // 渲染页面
        return view('Fansmanage/Api/material_articles_edit', ['id' => $id, 'num' => $num, 'articles' => $articles, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 编辑多条图文数据提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function material_articles_edit_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取编辑的id
        $id = $request->input('id');
        // 获取数量
        $num = $request->get('num');
        // 初始化
        $adata['articles'] = [];
        // 标识，判断微信接口是否正确
        $flag = true;
        // 获取图文信息
        $article_info = WechatArticle::getOne([['id', $id]]);
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($admin_data['organization_id']);
        // 处理数据
        for ($i = 1; $i <= $num; $i++) {
            array_push($adata['articles'], [
                'title' => $request->get('title_' . $i),
                'thumb_media_id' => $request->get('thumb_media_id_' . $i),
                'author' => $request->get('author_' . $i),
                'digest' => '',
                'show_cover_pic' => 1,
                'content' => $request->get('content_' . $i),
                'content_source_url' => $request->get('origin_url_' . $i),
            ]);

            $data['articles'] = [
                'title' => $request->get('title_' . $i),
                'thumb_media_id' => $request->get('thumb_media_id_' . $i),
                'author' => $request->get('author_' . $i),
                'digest' => '',
                'show_cover_pic' => 1,
                'content' => $request->get('content_' . $i),
                'content_source_url' => $request->get('origin_url_' . $i),
            ];
            // 更新微信公众号上面的 图文信息
            $re = \Wechat::update_meterial($auth_info['authorizer_access_token'], $article_info['media_id'], $i - 1, $data);
            // 如果接口出错了,就不数据库数据的更新
            if ($re['errcode'] <> '0') {
                $flag = false;
            }
        }
        // 判断是否要进行数据更新
        if ($flag) {
            $zdata = [
                'title' => $request->get('title_1'),
                'content' => serialize($adata),
            ];
            // 更新数据
            WechatArticle::editWechatArticle([['id', $id]], $zdata);
            // 返回提示
            return response()->json(['data' => '编辑图文素材成功', 'status' => '1']);
        } else {
            return response()->json(['data' => '编辑图文素材失败', 'status' => '0']);
        }

    }

    /**
     * 图片选择页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function material_image_select(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        $i = $request->input('i');
        // 获取图片数据
        $list = WechatImage::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Api/material_image_select', ['list' => $list, 'i' => $i]);
    }
}