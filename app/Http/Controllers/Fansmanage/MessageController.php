<?php
/**
 * 回复 消息 模块，包括：
 *   关键字自动回复，默认回复
 */

namespace App\Http\Controllers\Fansmanage;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use App\Models\WechatArticle;
use App\Models\WechatAuthorization;
use App\Models\WechatAuthorizerInfo;
use App\Models\WechatDefaultReply;
use App\Models\WechatImage;
use App\Models\WechatReply;
use App\Models\WechatSubscribeReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MessageController extends CommonController
{
    /**
     * 关键字自动回复列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取微信公众号关键字回复信息 并且 进行分页
        $list = WechatReply::getPaginage([['organization_id', $this->admin_data['organization_id']]], 15, 'id', 'desc');
        // 渲染关键字回复页面，并且将系统信息输出
        return view('Fansmanage/Message/auto_reply', ['list' => $list, 'admin_data' => $this->admin_data, 'route_name' => $this->route_name, 'menu_data' => $this->menu_data, 'son_menu_data' => $this->son_menu_data]);
    }

    /**
     * 关键字添加页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_add(Request $request)
    {
        // 渲染添加的页面
        return view('Fansmanage/Message/auto_reply_add');
    }

    /**
     * 添加关键字数据
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_add_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关键字
        $keyword = request()->input('keyword');
        // 中间件产生的 关键字类型:  1-精确 2-模糊
        $type = request()->input('type');
        // 中间件产生的 角色权限节点-组织id, 公众号管理组织
        $organization_id = $this->admin_data['organization_id'];
        // 通过组织id 获取公众号基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $organization_id]]);
        // 授权appid
        $authorizer_appid = $appinfo['authorizer_appid'];

        // 检测在该组织里面,所对应的 关键字是否已经 添加过
        // 是：添加过就进行 已添加 的消息提示
        // 否：进行添加
        if (WechatReply::checkRowExists([['organization_id', $organization_id], ['keyword', $keyword]])) {//判断是否添加过相同的的角色
            return $this->getResponseMsg("0", "您添加的关键字已经存在");
        } else {
            // 事务处理
            DB::beginTransaction();
            try {
                // 成功就进行数据提交，并且添加操作记录
                $data = ['organization_id' => $organization_id, 'authorizer_appid' => $authorizer_appid, 'keyword' => $keyword, 'type' => $type];
                // 添加到 关键字回复表
                WechatReply::addWechatReply($data);
                // 保存操作记录
                $this->insertOperationLog("1", '添加了自动回复关键字' . $keyword);
                DB::commit();
            } catch (\Exception $e) {
                // 失败就进行数据回滚，然后返回 添加失败 的提示
                DB::rollBack();
                return $this->getResponseMsg("0", "添加关键字失败，请检查");
            }
            // 返回添加成功的提示
            return $this->getResponseMsg("1", "添加关键字成功");
        }
    }

    /**
     * 添加关键字文本回复 页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_edit_text()
    {
        // 获取中间件产生的 要编辑的关键字 的记录数的 id值
        $id = request()->input('id');
        // 获取该关键字数据信息
        $info = WechatReply::getOne([['id', $id]]);
        // 渲染页面，并且返回的关键字信息
        return view('Fansmanage/Message/auto_reply_edit_text', ['id' => $id, 'info' => $info]);
    }


    /**
     * 编辑自动回复文本内容
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_edit_text_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 文本回复：值为1
        $reply_type = 1;
        // 回复的内容
        $reply_info = request()->input('reply_info');
        // 获取关键字信息
        $info = WechatReply::getOne([['id', $id]]);

        // 事务处理
        DB::beginTransaction();
        try {
            $data = ['reply_type' => $reply_type, 'reply_info' => $reply_info, 'media_id' => ''];
            // 添加关键字回复主体内容
            WechatReply::editWechatReply([['id', $id]], $data);
            // 添加操作记录
            $this->insertOperationLog("1", "修改了自动回复关键字{$info['keyword']}的文本回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改自动回复关键字的文本回复失败，请检查");
        }
        return $this->getResponseMsg("1", "修改自动回复关键字的文本回复成功");
    }

    /*
   * 关键字自动回复回复图片内容
   */
    public function auto_reply_edit_image(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');
        $info = WechatReply::getOne([['id', $id]]);
        $list = WechatImage::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/auto_reply_edit_image', ['id' => $id, 'info' => $info, 'list' => $list]);
    }

    /*
    * 编辑自动回复图片内容
    */
    public function auto_reply_edit_image_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $image_id = $request->input('image_id');
        $image_info = WechatImage::getOne([['id', $image_id]]);

        $media_id = $image_info['media_id'];
        $reply_info = $image_info['filename'];

        $reply_type = 2;
        $info = WechatReply::getOne([['id', $id]]);

        DB::beginTransaction();
        try {
            $data = ['reply_type' => $reply_type, 'reply_info' => $reply_info, 'media_id' => $media_id];
            WechatReply::editWechatReply([['id', $id]], $data);
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了自动回复关键字' . $info['keyword'] . '的图片回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自动回复关键字的图片回复失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自动回复关键字的图片回复成功', 'status' => '1']);
    }

    /*
  * 关键字自动回复回复图片内容
  */
    public function auto_reply_edit_article(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');
        $info = WechatReply::getOne([['id', $id]]);
        $list = WechatArticle::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/auto_reply_edit_article', ['id' => $id, 'info' => $info, 'list' => $list]);
    }

    /*
    * 编辑自动回复图文内容
    */
    public function auto_reply_edit_article_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $article_id = $request->input('article_id');
        $article_info = WechatArticle::getOne([['id', $article_id]]);

        $media_id = $article_info['media_id'];
        $reply_info = $article_info['title'];

        $reply_type = 3;
        $info = WechatReply::getOne([['id', $id]]);

        DB::beginTransaction();
        try {
            $data = ['reply_type' => $reply_type, 'reply_info' => $reply_info, 'media_id' => $media_id];
            WechatReply::editWechatReply([['id', $id]], $data);
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了自动回复关键字' . $info['keyword'] . '的图文回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自动回复关键字的图文回复失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自动回复关键字的图文回复成功', 'status' => '1']);
    }

    /*
     * 编辑自动回复关键字
     */
    public function auto_reply_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $id = $request->input('id');
        $info = WechatReply::getOne([['id', $id]]);
        return view('Fansmanage/Message/auto_reply_edit', ['id' => $id, 'info' => $info]);
    }

    /*
     * 编辑关键字数据提交
     */
    public function auto_reply_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        $keyword = $request->input('keyword');
        $type = $request->input('type');
        DB::beginTransaction();
        try {
            $data = ['keyword' => $keyword, 'type' => $type];
            WechatReply::editWechatReply([['id', $id]], $data);
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了自动回复关键字' . $keyword);//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改自动回复关键字失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自动回复关键字成功', 'status' => '1']);
    }

    /*
   * 删除图文回复关键字
   */
    public function auto_reply_delete_confirm(Request $request)
    {
        $id = $request->input('id');
        return view('Fansmanage/Message/auto_reply_delete_confirm', ['id' => $id]);
    }

    /*
     * 删除图文回复数据提交
     */
    public function auto_reply_delete_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $id = $request->input('id');
        DB::beginTransaction();
        try {
            WechatReply::where('id', $id)->delete();
            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '删除了自动回复关键字');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '删除自动回复关键字失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除自动回复关键字成功', 'status' => '1']);
    }

    /*
     * 关注后回复
     */
    public function subscribe_reply(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        return view('Fansmanage/Message/subscribe_reply', ['info' => $info, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /*
     * 关注后文字回复内容弹窗
     */
    public function subscribe_reply_text_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        return view('Fansmanage/Message/subscribe_reply_text_edit', ['info' => $info]);
    }

    /*
     * 关注后文字回复保存
     */
    public function subscribe_reply_text_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $text_info = $request->input('text_info');
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'text_info' => $text_info,
                    'reply_type' => '1',
                ];
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                $data = ['text_info' => $text_info, 'reply_type' => '1'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的文本回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的文本回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的文本回复内容成功', 'status' => '1']);
    }

    /*
     * 关注后图片回复内容弹窗
     */
    public function subscribe_reply_image_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $list = WechatImage::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/subscribe_reply_image_edit', ['list' => $list, 'info' => $info]);
    }

    /*
     * 关注后图片回复保存
     */
    public function subscribe_reply_image_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $media_id = $request->input('media_id');
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'image_media_id' => $media_id,
                    'reply_type' => '2',
                ];
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                $data = ['image_media_id' => $media_id, 'reply_type' => '2'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的图片回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的图片回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的图片回复内容成功', 'status' => '1']);
    }

    /*
     * 关注后图文回复内容弹窗
     */
    public function subscribe_reply_article_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $list = WechatArticle::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/subscribe_reply_article_edit', ['list' => $list, 'info' => $info]);
    }

    /*
     * 关注后图文回复保存
     */
    public function subscribe_reply_article_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $media_id = $request->input('media_id');
        $info = WechatSubscribeReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'article_media_id' => $media_id,
                    'reply_type' => '3',
                ];
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                $data = ['article_media_id' => $media_id, 'reply_type' => '3'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的图文回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的图文回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的图文回复内容成功', 'status' => '1']);
    }


    /*
     * 默认回复
     */
    public function default_reply(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $menu_data = $request->get('menu_data');//中间件产生的管理员数据参数
        $son_menu_data = $request->get('son_menu_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        return view('Fansmanage/Message/default_reply', ['info' => $info, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /*
     * 默认文本回复内容弹窗
     */
    public function default_reply_text_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        return view('Fansmanage/Message/default_reply_text_edit', ['info' => $info]);
    }

    /*
     * 默认文本回复保存
     */
    public function default_reply_text_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $text_info = $request->input('text_info');
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'text_info' => $text_info,
                    'reply_type' => '1',
                ];
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                $data = ['text_info' => $text_info, 'reply_type' => '1'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的文本回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            dump($e);
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的文本回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的文本回复内容成功', 'status' => '1']);
    }

    //默认图片回复内容弹窗
    public function default_reply_image_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $list = WechatImage::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/default_reply_image_edit', ['list' => $list, 'info' => $info]);
    }

    //默认图片回复保存
    public function default_reply_image_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $media_id = $request->input('media_id');
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'image_media_id' => $media_id,
                    'reply_type' => '2',
                ];
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                $data = ['image_media_id' => $media_id, 'reply_type' => '2'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的图片回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的图片回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的图片回复内容成功', 'status' => '1']);
    }

    //默认图文回复内容弹窗
    public function default_reply_article_edit(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $list = WechatArticle::getList([['organization_id', $admin_data['organization_id']]], '', 'id', 'desc');
        return view('Fansmanage/Message/default_reply_article_edit', ['list' => $list, 'info' => $info]);
    }

    //默认图文回复保存
    public function default_reply_article_edit_check(Request $request)
    {
        $admin_data = $request->get('admin_data');//中间件产生的管理员数据参数
        $route_name = $request->path();//获取当前的页面路由
        $media_id = $request->input('media_id');
        $info = WechatDefaultReply::getOne([['organization_id', $admin_data['organization_id']]]);
        $appinfo = WechatAuthorization::getOne([['organization_id', $admin_data['organization_id']]]);
        $authorizer_appid = $appinfo['authorizer_appid'];

        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'article_media_id' => $media_id,
                    'reply_type' => '3',
                ];
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                $data = ['article_media_id' => $media_id, 'reply_type' => '3'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $admin_data['organization_id']]], $data);
            }

            OperationLog::addOperationLog('1', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了关注自动回复' . $info['keyword'] . '的图文回复内容');//保存操作记录
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();//事件回滚
            return response()->json(['data' => '修改关注自动回复的图文回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的图文回复内容成功', 'status' => '1']);
    }


}