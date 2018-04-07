<?php
/**
 * 回复 消息 模块，包括：
 *   关键字自动回复，默认回复，订阅事件回复
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
use Illuminate\Support\Facades\DB;
use Session;

class MessageController extends CommonController
{
    // +----------------------------------------------------------------------
    // | Start - 关键字回复信息
    // +----------------------------------------------------------------------
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_add()
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

    /**
     * 关键字自动回复回复图片内容
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_edit_image()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 获取关键字信息
        $info = WechatReply::getOne([['id', $id]]);
        // 获取微信公众号 图片素材列表
        $list = WechatImage::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/auto_reply_edit_image', ['id' => $id, 'info' => $info, 'list' => $list]);
    }


    /**
     * 编辑自动回复图片内容
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_edit_image_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 关键字的记录id
        $id = request()->input('id');
        // 获取选择到的图片的id
        $image_id = request()->input('image_id');
        // 获取微信图片素材信息
        $image_info = WechatImage::getOne([['id', $image_id]]);

        // 图片信息
        $media_id = $image_info['media_id'];
        $reply_info = $image_info['filename'];

        // 图片类型：值为2
        $reply_type = 2;
        // 获取回复的信息
        $info = WechatReply::getOne([['id', $id]]);

        // 事务处理
        DB::beginTransaction();
        try {
            $data = ['reply_type' => $reply_type, 'reply_info' => $reply_info, 'media_id' => $media_id];
            // 添加关键字回复主体内容
            WechatReply::editWechatReply([['id', $id]], $data);
            // 添加操作记录
            $this->insertOperationLog("1", "修改了自动回复关键字{$info['keyword']}的图片回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改自动回复关键字的图片回复失败，请检查");
        }
        return $this->getResponseMsg("1", "修改自动回复关键字的图片回复成功");
    }


    /**
     * 关键字自动回复图文信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_edit_article()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 获取关键字信息
        $info = WechatReply::getOne([['id', $id]]);
        // 获取微信公众号 图文素材列表
        $list = WechatArticle::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/auto_reply_edit_article', ['id' => $id, 'info' => $info, 'list' => $list]);
    }

    /**
     * 编辑自动回复图文内容
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_edit_article_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 中间件产生的 微信公众号图文信息id
        $article_id = request()->input('article_id');
        // 获取微信公众号图文信息
        $article_info = WechatArticle::getOne([['id', $article_id]]);

        // 图文信息
        $media_id = $article_info['media_id'];
        $reply_info = $article_info['title'];

        // 图文信息：值为3
        $reply_type = 3;
        // 获取回复信息
        $info = WechatReply::getOne([['id', $id]]);

        // 事务处理
        DB::beginTransaction();
        try {
            $data = ['reply_type' => $reply_type, 'reply_info' => $reply_info, 'media_id' => $media_id];
            // 添加关键字回复主体内容
            WechatReply::editWechatReply([['id', $id]], $data);
            // 添加操作记录
            $this->insertOperationLog("1", "修改了自动回复关键字{$info['keyword']}的图文回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改自动回复关键字的图文回复失败，请检查");
        }
        return $this->getResponseMsg("1", "修改自动回复关键字的图文回复成功");
    }

    /**
     * 编辑自动回复关键字
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 获取关键字信息
        $info = WechatReply::getOne([['id', $id]]);
        // 渲染页面
        return view('Fansmanage/Message/auto_reply_edit', ['id' => $id, 'info' => $info]);
    }

    /**
     * 编辑关键字数据提交
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 中间件产生的 关键字
        $keyword = request()->input('keyword');
        // 中间件产生的 关键字的类型
        $type = request()->input('type');
        // 事务处理
        DB::beginTransaction();
        try {
            $data = ['keyword' => $keyword, 'type' => $type];
            // 添加关键字回复主体内容
            WechatReply::editWechatReply([['id', $id]], $data);
            // 添加操作记录
            $this->insertOperationLog("1", "修改了自动回复关键字{$keyword}");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改自动回复关键字失败，请检查");
        }
        return $this->getResponseMsg("1", "修改自动回复关键字成功");
    }

    /**
     * 删除图文回复关键字
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auto_reply_delete_confirm()
    {
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');
        // 渲染页面
        return view('Fansmanage/Message/auto_reply_delete_confirm', ['id' => $id]);
    }


    /**
     * 删除图文回复数据提交
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function auto_reply_delete_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 关于关键字回复的id
        $id = request()->input('id');

        // 事务处理
        DB::beginTransaction();
        try {
            // 找到相对应的数据，进行删除
            WechatReply::where('id', $id)->delete();
            // 添加操作记录
            $this->insertOperationLog("1", "删除了自动回复关键字");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "删除自动回复关键字失败，请检查");
        }
        return $this->getResponseMsg("1", "删除自动回复关键字成功");
    }
    // +----------------------------------------------------------------------
    // | End - 关键字回复信息
    // +----------------------------------------------------------------------


    // +----------------------------------------------------------------------
    // | Start - 订阅回复信息
    // +----------------------------------------------------------------------
    /**
     * 订阅事件回复
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribe_reply()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取订阅回复信息
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 渲染页面
        return view('Fansmanage/Message/subscribe_reply', ['info' => $info, 'admin_data' => $this->admin_data, 'route_name' => $this->route_name, 'menu_data' => $this->menu_data, 'son_menu_data' => $this->son_menu_data]);
    }


    /**
     * 关注后文字回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribe_reply_text_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取订阅回复信息
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 渲染页面
        return view('Fansmanage/Message/subscribe_reply_text_edit', ['info' => $info]);
    }


    /**
     * 关注后文字回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function subscribe_reply_text_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 订阅信息内容主体
        $text_info = request()->input('text_info');
        // 获取订阅回复信息
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号授权基本信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 微信公众号的授权appid
        $authorizer_appid = $appinfo['authorizer_appid'];

        // 事务处理
        DB::beginTransaction();
        try {
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'text_info' => $text_info,
                    'reply_type' => '1',
                ];
                // 添加订阅信息
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                // 编辑订阅信息
                $data = ['text_info' => $text_info, 'reply_type' => '1'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }
            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的文本回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改关注自动回复的文本回复内容失败，请检查");
        }
        return $this->getResponseMsg("1", "修改关注自动回复的文本回复内容成功");
    }

    /**
     * 关注后图片回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribe_reply_image_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取订阅回复信息
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号图片素材信息
        $list = WechatImage::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/subscribe_reply_image_edit', ['list' => $list, 'info' => $info]);
    }


    /**
     * 关注后图片回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function subscribe_reply_image_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 素材id
        $media_id = request()->input('media_id');
        // 获取订阅信息内容
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号授权基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号基础信息
        $authorizer_appid = $appinfo['authorizer_appid'];

        // 事务处理
        DB::beginTransaction();
        try {
            // 判断是否保存过信息
            // 是：进行编辑
            // 否：进行添加
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'image_media_id' => $media_id,
                    'reply_type' => '2',
                ];
                // 添加订阅信息
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                // 编辑订阅信息
                $data = ['image_media_id' => $media_id, 'reply_type' => '2'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }

            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的图片回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '修改关注自动回复的图片回复内容失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改关注自动回复的图片回复内容成功', 'status' => '1']);
    }

    /**
     * 关注后图文回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribe_reply_article_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取订阅回复信息
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号图文素材信息
        $list = WechatArticle::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/subscribe_reply_article_edit', ['list' => $list, 'info' => $info]);
    }

    /**
     * 关注后图文回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function subscribe_reply_article_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 中间件产生的 素材id
        $media_id = request()->input('media_id');
        // 获取订阅信息内容
        $info = WechatSubscribeReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号授权基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号基础信息
        $authorizer_appid = $appinfo['authorizer_appid'];

        // 事务处理
        DB::beginTransaction();
        try {
            // 判断是否保存过信息
            // 是：进行编辑
            // 否：进行添加
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'article_media_id' => $media_id,
                    'reply_type' => '3',
                ];
                // 添加订阅信息
                WechatSubscribeReply::addWechatSubscribeReply($data);
            } else {
                // 编辑订阅信息
                $data = ['article_media_id' => $media_id, 'reply_type' => '3'];
                WechatSubscribeReply::editWechatSubscribeReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }

            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的图文回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改关注自动回复的图文回复内容失败，请检查");
        }
        return $this->getResponseMsg("1", "修改关注自动回复的图文回复内容成功");
    }
    // +----------------------------------------------------------------------
    // | End - 订阅回复信息
    // +----------------------------------------------------------------------


    // +----------------------------------------------------------------------
    // | Start - 默认回复信息
    // +----------------------------------------------------------------------
    /**
     * 默认回复
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function default_reply()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 渲染页面
        return view('Fansmanage/Message/default_reply', ['info' => $info, 'admin_data' => $this->admin_data, 'route_name' => $this->route_name, 'menu_data' => $this->menu_data, 'son_menu_data' => $this->son_menu_data]);
    }

    /**
     * 默认文本回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function default_reply_text_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 渲染页面
        return view('Fansmanage/Message/default_reply_text_edit', ['info' => $info]);
    }

    /**
     * 默认文本回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function default_reply_text_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取默认回复文本内容
        $text_info = request()->input('text_info');
        // 获取默认回复的信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号授权基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 微信公众号授权 appid
        $authorizer_appid = $appinfo['authorizer_appid'];

        // 事务处理
        DB::beginTransaction();
        try {
            // 判断是否已存在默认回复的信息
            // 是：进行编辑
            // 否：进行添加
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'text_info' => $text_info,
                    'reply_type' => '1',
                ];
                // 默认回复添加数据
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                // 默认回复编辑数据
                $data = ['text_info' => $text_info, 'reply_type' => '1'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }

            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的文本回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改关注自动回复的文本回复内容失败，请检查");
        }
        return $this->getResponseMsg("1", "修改关注自动回复的文本回复内容成功");
    }

    /**
     * 默认图片回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function default_reply_image_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信图片素材列表
        $list = WechatImage::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/default_reply_image_edit', ['list' => $list, 'info' => $info]);
    }

    /**
     * 默认图片回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function default_reply_image_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取选择的素材id
        $media_id = request()->input('media_id');
        // 获取默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 微信公众号授权 appid
        $authorizer_appid = $appinfo['authorizer_appid'];
        // 事务处理
        DB::beginTransaction();
        try {
            // 判断是否已存在默认回复的信息
            // 是：进行编辑
            // 否：进行添加
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'image_media_id' => $media_id,
                    'reply_type' => '2',
                ];
                // 默认回复添加数据
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                // 默认回复编辑信息
                $data = ['image_media_id' => $media_id, 'reply_type' => '2'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }

            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的图片回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改关注自动回复的图片回复内容失败，请检查");
        }
        return $this->getResponseMsg("1", "修改关注自动回复的图片回复内容成功");
    }

    /**
     * 默认图文回复内容弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function default_reply_article_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信图文素材列表
        $list = WechatArticle::getList([['organization_id', $this->admin_data['organization_id']]], '', 'id', 'desc');
        // 渲染页面
        return view('Fansmanage/Message/default_reply_article_edit', ['list' => $list, 'info' => $info]);
    }

    /**
     * 默认图文回复保存
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function default_reply_article_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取微信公众号素材id
        $media_id = request()->input('media_id');
        // 获取微信公众号默认回复信息
        $info = WechatDefaultReply::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取微信公众号基础信息
        $appinfo = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 微信公众号授权 appid
        $authorizer_appid = $appinfo['authorizer_appid'];
        // 事务处理
        DB::beginTransaction();
        try {
            // 判断是否已存在默认回复的信息
            // 是：进行编辑
            // 否：进行添加
            if (empty($info)) {
                $data = [
                    'organization_id' => $this->admin_data['organization_id'],
                    'authorizer_appid' => $authorizer_appid,
                    'article_media_id' => $media_id,
                    'reply_type' => '3',
                ];
                // 默认回复添加数据
                WechatDefaultReply::addWechatDefaultReply($data);
            } else {
                // 默认回复编辑数据
                $data = ['article_media_id' => $media_id, 'reply_type' => '3'];
                WechatDefaultReply::editWechatDefaultReply([['organization_id', $this->admin_data['organization_id']]], $data);
            }

            // 添加操作记录
            $this->insertOperationLog("1", "修改了关注自动回复{$info['keyword']}的图文回复内容");
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return $this->getResponseMsg("0", "修改关注自动回复的图文回复内容失败，请检查");
        }
        return $this->getResponseMsg("1", "修改关注自动回复的图文回复内容成功");
    }
    // +----------------------------------------------------------------------
    // | End - 默认回复信息
    // +----------------------------------------------------------------------
}