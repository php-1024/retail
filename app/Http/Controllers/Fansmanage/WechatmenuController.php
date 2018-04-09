<?php
/**
 * 自定义菜单 模块，包括：
 *   自定义菜单，个性化菜单
 *   同时还具备一键上传到微信公众号的功能
 */

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

class WechatmenuController extends CommonController
{
    // +----------------------------------------------------------------------
    // | Start - 自定义菜单
    // +----------------------------------------------------------------------

    /**
     * 自定义菜单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defined_menu()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 渲染页面
        return view('Fansmanage/Wechatmenu/defined_menu', ['admin_data' => $this->admin_data, 'route_name' => $this->route_name, 'menu_data' => $this->menu_data, 'son_menu_data' => $this->son_menu_data]);
    }

    /**
     * 自定义菜单添加页面-页面上面右边部分
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defined_menu_add()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']]], 0, 'id', 'DESC');
        // 获取菜单列表
        $list = WechatDefinedMenu::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']], ['parent_id', '0']], 0, 'id', 'DESC');
        // 渲染页面
        return view('Fansmanage/Wechatmenu/defined_menu_add', ['list' => $list, 'wechatreply' => $wechatreply]);
    }

    /**
     * 添加自定义菜单检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function defined_menu_add_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取事件类型
        $event_type = request()->get('event_type');
        // 获取响应类型
        $response_type = request()->get('response_type');
        // 获取组织ID
        $organization_id = $this->admin_data['organization_id'];
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取新建菜单名称
        $menu_name = request()->get('menu_name');
        // 获取上级菜单ID
        $parent_id = request()->get('parent_id');

        // 菜单的级别数据结构 : 第一级为 0
        if ($parent_id == 0) {
            $parent_tree = '0,';
        } else {
            $parent_tree = '0,' . $parent_id . ',';
        }

        // 获取响应网址
        $response_url = request()->get('response_url');
        // 获取响应关键字
        $response_keyword = request()->get('response_keyword');
        // 数据处理
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

        // 判断菜单结构是否符合微信标准
        $res_menu = $this->judgeMenuStandard($parent_id, "defined");
        if ($res_menu !== true) {
            return $res_menu;
        }

        // 事务处理
        DB::beginTransaction();
        try {
            // 添加微信自定义菜单
            WechatDefinedMenu::addDefinedMenu($defined_menu);
            // 添加操作日志
            if ($this->admin_data['is_super'] == 1) {
                // 超级管理员操作商户的记录
                $this->insertOperationLog("1", "在餐饮系统添加了公众号自定义菜单！", "1", "1");
            } else {
                // 商户本人操作记录
                $this->insertOperationLog("4", "添加了公众号自定义菜单！");
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '添加自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加自定义菜单成功！', 'status' => '1']);
    }

    /**
     * 获取菜单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defined_menu_get()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取主菜单列表
        $list = WechatDefinedMenu::getList([['organization_id', $this->admin_data['organization_id']], ['parent_id', '0']], 0, 'id', 'asc');
        // 处理菜单数据
        $son_menu = [];
        foreach ($list as $key => $val) {
            // 获取其他多级菜单
            $sm = WechatDefinedMenu::getList([['organization_id', $this->admin_data['organization_id']], ['parent_id', $val->id]], 0, 'id', 'asc');
            // 处理数据
            if (!empty($sm)) {
                $son_menu[$val->id] = $sm;
            }
            unset($sm);
        }
        // 渲染已有菜单数据
        return view('Fansmanage/Wechatmenu/defined_menu_get', ['list' => $list, 'son_menu' => $son_menu]);
    }

    /**
     * 自定义菜单编辑页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function defined_menu_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取编辑的数据的id
        $id = request()->get('id');
        // 获取要修改的菜单的数据
        $definedmenu = WechatDefinedMenu::getOne([['id', $id]]);
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']]], 0, 'id', 'DESC');
        // 获取上级菜单的数据
        $list = WechatDefinedMenu::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']], ['parent_id', '0']], 0, 'id', 'DESC');
        // 渲染页面
        return view('Fansmanage/Wechatmenu/defined_menu_edit', ['list' => $list, 'wechatreply' => $wechatreply, 'definedmenu' => $definedmenu]);
    }

    /**
     * 编辑自定义菜单检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function defined_menu_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取事件类型
        $event_type = request()->get('event_type');
        // 菜单ID
        $menu_id = request()->get('menu_id');
        // 组织ID
        $organization_id = $this->admin_data['organization_id'];
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取菜单名称
        $menu_name = request()->get('menu_name');
        // 获取上级菜单ID
        $parent_id = request()->get('parent_id');
        // 获取菜单的上级id
        $menu_parent_id = WechatDefinedMenu::getPluck([['id', $menu_id]], 'parent_id')->first();

        // 如果父级id改变就进行 判断菜单是否符合以下条件
        if ($menu_parent_id != $parent_id) {
            // 判断菜单结构是否符合微信标准
            $res_menu = $this->judgeMenuStandard($parent_id, "defined");
            if ($res_menu !== true) {
                return $res_menu;
            }
        }

        // 菜单的级别数据结构 : 第一级为 0
        if ($parent_id == 0) {
            $parent_tree = '0,';
        } else {
            $parent_tree = '0,' . $parent_id . ',';
        }

        // 获取响应网址
        $response_url = request()->get('response_url');
        // 获取响应关键字
        $response_keyword = request()->get('response_keyword');
        // 获取响应类型
        $response_type = request()->get('response_type');
        // 处理数据
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

        // 事务处理
        DB::beginTransaction();
        try {
            // 编辑微信自定义菜单
            WechatDefinedMenu::editDefinedMenu(['id' => $menu_id], $defined_menu);
            // 添加操作日志
            if ($this->admin_data['is_super'] == 1) {
                // 超级管理员操作商户的记录
                $this->insertOperationLog("1", "在餐饮系统修改了公众号自定义菜单！", "1", "1");
            } else {
                // 商户本人操作记录
                $this->insertOperationLog("4", "修改了公众号自定义菜单！");
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '修改自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自定义菜单成功！', 'status' => '1']);
    }

    /**
     * 自定义菜单删除弹窗
     */
    public function defined_menu_delete()
    {
        // 渲染页面
        return view('Fansmanage/Wechatmenu/defined_menu_delete', ['id' => request()->get('id')]);
    }

    /**
     * 自定义菜单删除检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function defined_menu_delete_check($a)
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 菜单id
        $id = request()->get('id');
        // 事务处理
        DB::beginTransaction();
        try {
            // 获取微信公众号菜单信息
            $data = WechatDefinedMenu::getOne([['id', $id]]);
            // 如果要通过 菜单id 找到的是主菜单
            if ($data['parent_id'] == 0) {
                // 树形结构
                $parent_tree = '0,' . $id . ',';
                // 删除子级菜单
                WechatDefinedMenu::removeDefinedMenu([['parent_tree', $parent_tree]]);
            }
            // 删除顶级菜单
            WechatDefinedMenu::removeDefinedMenu([['id', $id]]);
            // 添加操作日志
            if ($this->admin_data['is_super'] != 2) {
                // 超级管理员操作商户的记录
                $this->insertOperationLog("3", "删除了公众号自定义菜单！");
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '删除自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除自定义菜单成功！', 'status' => '1']);
    }


    /**
     * 一键同步到微信公众号页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wechat_menu_add()
    {
        // 渲染页面
        return view('Fansmanage/Wechatmenu/wechat_menu_add');
    }

    /**
     * 一键同步到微信公众号 检测
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechat_menu_add_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取组织id
        $organization_id = $this->admin_data['organization_id'];
        // 获取主菜单列表
        $list = WechatDefinedMenu::ListWechatDefinedMenu([['parent_id', '0'], ['organization_id', $organization_id]]);
        // 处理菜单数据结构
        foreach ($list as $key => $value) {
            // 子菜单结构
            $parent_tree = $value['parent_tree'] . $value['id'] . ',';
            // 获取子菜单结构
            $re = WechatDefinedMenu::ListWechatDefinedMenu([['parent_tree', $parent_tree]])->toArray();
            // 判断是否存在子菜单
            if ($re) {
                // 如果存在子菜单，拼接数据结构
                foreach ($re as $k => $v) {
                    // 获取菜单类型名称
                    $type = $this->getEventType($v['event_type']);
                    // 获取菜单的名称
                    $data['button'][$key]['name'] = $value['menu_name'];
                    // 如果菜单类型为 1 ：跳转地址
                    if ($v['event_type'] == 1) {
                        $data['button'][$key]['sub_button'][] = [
                            'name' => $v['menu_name'],
                            'type' => $type,
                            'url' => $v['response_url']
                        ];
                    } else {
                        // 其他：通过 key 值去渲染
                        $data['button'][$key]['sub_button'][] = [
                            'name' => $v['menu_name'],
                            'type' => $type,
                            'key' => $v['response_keyword']
                        ];
                    }
                }
            } else {
                // 没有子菜单的情况
                $type = $this->getEventType($value['event_type']);
                // 渲染数据
                $data['button'][$key]['name'] = $value['menu_name'];
                $data['button'][$key]['type'] = $type;
                // 判断主菜单的类型
                if ($value['event_type'] == 1) {
                    $data['button'][$key]['url'] = $value['response_url'];
                } else {
                    $data['button'][$key]['key'] = $value['response_keyword'];
                }
            }
        }

        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($organization_id);

        // 创建微信菜单
        $re = \Wechat::create_menu($auth_info['authorizer_access_token'], $data);
        $re = json_decode($re, true);

        // 返回创建的数据结构
        if ($re['errcode'] == 0) {
            $response = $this->getResponseMsg(1, "同步成功！");
        } else {
            // 如果存在微信公众号报错信息
            if (!empty($re['errmsg'])) {
                $response = $this->getResponseMsg(0, $re["errmsg"]);
            } else {
                $response = $this->getResponseMsg(0, "同步失败！");
            }
        }
        return $response;
    }
    // +----------------------------------------------------------------------
    // | End - 自定义菜单
    // +----------------------------------------------------------------------


    // +----------------------------------------------------------------------
    // | Start - 个性化菜单
    // +----------------------------------------------------------------------
    /**
     * 渲染个性化菜单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conditional_menu()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 渲染页面
        return view('Fansmanage/Wechatmenu/conditional_menu', ['admin_data' => $this->admin_data, 'route_name' => $this->route_name, 'menu_data' => $this->menu_data, 'son_menu_data' => $this->son_menu_data]);
    }

    /**
     * 自定义菜单添加页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conditional_menu_add()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取自定义菜单数据
        $label_list = Label::ListLabel(['fansmanage_id' => $this->admin_data['organization_id']]);
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']]], 0, 'id', 'DESC');
        // 渲染页面
        return view('Fansmanage/Wechatmenu/conditional_menu_add', ['label_list' => $label_list, 'wechatreply' => $wechatreply]);
    }

    /**
     * 显示上级菜单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conditional_menu_list()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取会员标签id
        $label_id = request()->label_id;
        // 拿到上级菜单的值
        $parent_id = request()->input("parent_id");

        // 声明菜单列表
        $list = [];
        // 判断是否存在会员标签
        if (!empty($label_id)) {
            // 如果存在会员标签，那么就将该标签对应的 菜单列出来
            // 获取授权APPID
            $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
            // 获取 微信公众号粉丝标签id
            $tag_id = Label::getPluck([['id', $label_id], ['store_id', '0']], 'wechat_id')->first();
            // 获取个性化菜单列表,粉丝标签id 获取到列表
            $list = WechatConditionalMenu::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']], ['parent_id', '0'], ['tag_id', $tag_id]], 0, 'id', 'DESC');
        }
        // 渲染页面
        return view('Fansmanage/Wechatmenu/conditional_menu_list', ['list' => $list, "parent_id" => $parent_id]);
    }

    /**
     * 添加个性化菜单检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function conditional_menu_add_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取事件类型
        $event_type = request()->get('event_type');
        // 获取响应类型
        $response_type = request()->get('response_type');
        // 组织ID
        $organization_id = $this->admin_data['organization_id'];
        // 会员标签id
        $label_id = request()->label_id;

        // 获取 微信公众号粉丝标签id
        $tag_id = Label::getPluck([['id', $label_id], ['store_id', '0']], 'wechat_id')->first();
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取菜单名称
        $menu_name = request()->get('menu_name');
        // 获取上级菜单ID
        $parent_id = request()->get('parent_id');

        // 菜单的级别数据结构 : 第一级为 0
        if ($parent_id == 0) {
            $parent_tree = '0,';
        } else {
            $parent_tree = '0,' . $parent_id . ',';
        }

        // 获取响应网址
        $response_url = request()->get('response_url');
        // 获取响应关键字
        $response_keyword = request()->get('response_keyword');
        // 处理数据
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

        // 判断 菜单是否符合公众号标准
        $res_menu = $this->judgeMenuStandard($parent_id, "conditional", $tag_id);
        if ($res_menu !== true) {
            return $res_menu;
        }
        // 事务处理
        DB::beginTransaction();
        try {
            // 添加菜单
            WechatConditionalMenu::addConditionalMenu($defined_menu);
            // 添加操作日志
            if ($this->admin_data['is_super'] != 2) {
                $this->insertOperationLog("3", '添加了公众号自定义菜单！');
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '添加自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '添加自定义菜单成功！', 'status' => '1']);
    }

    public function conditional_menu_get()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 会员标签id
        $label_id = request()->label_id;
        // 获取 标签的微信公众号标签id
        $tag_id = Label::getPluck([['id', $label_id], ['store_id', '0']], 'wechat_id')->first();
        // 获取菜单列表
        $list = WechatConditionalMenu::getList([['organization_id', $this->admin_data['organization_id']], ['tag_id', $tag_id], ['parent_id', '0']], 0, 'id', 'asc');
        $list = $list->toArray();

        // 个性化菜单
        $son_menu = [];
        // 判断菜单列表
        if (!empty($list)) {
            // 处理菜单数据
            foreach ($list as $key => $val) {
                // 组装子菜单
                $sm = WechatConditionalMenu::getList([['organization_id', $this->admin_data['organization_id']], ['tag_id', $tag_id], ['parent_id', $val['id']]], 0, 'id', 'asc');
                if (!empty($sm)) {
                    $son_menu[$val['id']] = $sm;
                }
                unset($sm);
            }
        }
        // 渲染页面
        return view('Fansmanage/Wechatmenu/conditional_menu_get', ['list' => $list, 'son_menu' => $son_menu]);
    }

    /**
     * 个性化菜单编辑页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conditional_menu_edit()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取id
        $id = request()->get('id');
        // 获取该id 对应的自定义菜单
        $conditionalmenu = WechatConditionalMenu::getOne([['id', $id]]);
        // 获取标签信息
        $label_info = Label::getInfo([['wechat_id', $conditionalmenu['tag_id']]], ["id", "label_name"]);
        //获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        //获取触发关键字列表
        $wechatreply = WechatReply::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']]], 0, 'id', 'DESC');
        //获取主菜单列表
        $list = WechatConditionalMenu::getList([['organization_id', $this->admin_data['organization_id']], ['authorizer_appid', $authorization['authorizer_appid']], ['parent_id', '0'], ['tag_id', $conditionalmenu['tag_id']], ['id', '<>', $conditionalmenu['id']]], 0, 'id', 'DESC');

        // 渲染页面
        return view('Fansmanage/Wechatmenu/conditional_menu_edit', ['list' => $list, 'wechatreply' => $wechatreply, 'conditionalmenu' => $conditionalmenu, 'label_info' => $label_info, 'edit_id' => $id]);
    }


    /**
     * 编辑个性化菜单检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function conditional_menu_edit_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取事件类型
        $event_type = request()->get('event_type');
        // 菜单ID
        $menu_id = request()->get('menu_id');
        // 组织ID
        $organization_id = $this->admin_data['organization_id'];
        // 获取授权APPID
        $authorization = WechatAuthorization::getOne([['organization_id', $this->admin_data['organization_id']]]);
        // 获取菜单名称
        $menu_name = request()->get('menu_name');
        // 获取上级菜单ID
        $parent_id = request()->get('parent_id');
        // 获取目前菜单的信息
        $data = WechatConditionalMenu::getOne([['id', $menu_id]]);
//        // 处理结构树
//        $ziparent_tree = $data['parent_tree'] . $data['id'] . ',';
//        // 判断是否子菜单
//        $re = WechatConditionalMenu::checkRowExists([['organization_id', $this->admin_data['organization_id']], ['tag_id', $data['tag_id']], ['parent_tree', $ziparent_tree]]);
//        if ($re) {
//            return response()->json(['data' => '菜单下面还有别的子菜单，不能更改', 'status' => '0']);
//        }

        // 如果id有改变
        if ($data['parent_id'] != $parent_id) {
            $res_menu = $this->judgeMenuStandard($parent_id, "conditional", $data["tag_id"]);
            if ($res_menu !== true) {
                return $res_menu;
            }
        }

        // 菜单的级别数据结构 : 第一级为 0
        if ($parent_id == 0) {
            $parent_tree = '0,';
        } else {
            $parent_tree = '0,' . $parent_id . ',';
        }

        // 获取响应网址
        $response_url = request()->get('response_url');
        // 获取响应关键字
        $response_keyword = request()->get('response_keyword');
        // 获取响应类型
        $response_type = request()->get('response_type');
        // 处理数据
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
        dump($defined_menu);


        // 事务处理
        DB::beginTransaction();
        try {
            // 编辑个性化菜单资料
            WechatConditionalMenu::editConditionalMenu(['id' => $menu_id], $defined_menu);
            // 添加操作日志
            if ($this->admin_data['is_super'] != 1) {
                // 超级管理员操作商户的记录
                $this->insertOperationLog("4", '修改了公众号自定义菜单！');
            }
            DB::commit();
        } catch (\Exception $e) {
            dump($e->getMessage());
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '修改自定义菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '修改自定义菜单成功！', 'status' => '1']);
    }

    /**
     * 自定义菜单删除弹窗
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function conditional_menu_delete()
    {
        return view('Fansmanage/Wechatmenu/conditional_menu_delete', ['id' => request()->get('id')]);
    }

    /**
     * 自定义菜单删除检测
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function conditional_menu_delete_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 菜单id
        $id = request()->get('id');
        // 事务处理
        DB::beginTransaction();
        try {
            // 菜单详情信息
            $data = WechatConditionalMenu::getOne([['id', $id]]);
            // 如果是最上级
            if ($data['parent_id'] == 0) {
                // 树形结构
                $parent_tree = '0,' . $id . ',';
                // 删除子级菜单
                WechatConditionalMenu::removeConditionalMenu([['parent_tree', $parent_tree]]);
            }
            // 删除顶级菜单
            WechatConditionalMenu::removeConditionalMenu([['id', $id]]);
            // 添加操作日志
            if ($this->admin_data['is_super'] != 2) {//超级管理员操作商户的记录
                $this->insertOperationLog("3", '删除了公众号个性化菜单！');
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '删除个性化菜单失败，请检查', 'status' => '0']);
        }
        return response()->json(['data' => '删除个性化菜单成功！', 'status' => '1']);
    }

    /**
     * 性化菜单一键同步到微信 页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wechat_conditional_menu_add()
    {
        return view('Fansmanage/Wechatmenu/wechat_conditional_menu_add', ['tag_id' => request()->get("tag_id")]);
    }

    /**
     * 个性化菜单一键同步到微信
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechat_conditional_menu_add_check()
    {
        // 中间件参数 集合
        $this->getRequestInfo();
        // 获取到标签
        $tag_id = request()->tag_id;
        // 判断是否存在标签的值
        if ($tag_id == '0') {
            return response()->json(['data' => '请先选择粉丝标签', 'status' => '0']);
        }
        // 获取到 标签的微信id
        $tag_id = Label::getPluck([['id', $tag_id], ['store_id', '0']], 'wechat_id')->first();
        // 获取 组织id
        $organization_id = $this->admin_data['organization_id'];

        // 获取某个标签下面的个性化主菜单列表
        $list = WechatConditionalMenu::ListConditionalMenu([['parent_id', '0'], ['tag_id', $tag_id], ['organization_id', $organization_id]]);

        // 处理菜单数据
        foreach ($list as $key => $value) {
            // 处理结构树
            $parent_tree = $value['parent_tree'] . $value['id'] . ',';
            // 获取某个结构树下面的子菜单数据
            $re = WechatConditionalMenu::ListConditionalMenu([['parent_tree', $parent_tree], ['tag_id', $tag_id], ['organization_id', $organization_id]])->toArray();

            // 判断是否存在子菜单结构
            if ($re) {
                // 存在子菜单的情况
                foreach ($re as $k => $v) {
                    // 获取菜单的类型
                    $type = $this->getEventType($v["event_type"]);
                    $data['button'][$key]['name'] = $value['menu_name'];
                    // 判断菜单类型
                    if ($v['event_type'] == 1) {
                        // 链接类型
                        $data['button'][$key]['sub_button'][] = [
                            'name' => $v['menu_name'],
                            'type' => $type,
                            'url' => $v['response_url']
                        ];
                    } else {
                        // 其他类型
                        $data['button'][$key]['sub_button'][] = [
                            'name' => $v['menu_name'],
                            'type' => $type,
                            'key' => $v['response_keyword']
                        ];
                    }
                }
            } else {
                // 没有子菜单的情况
                $type = $this->getEventType($value['event_type']);
                $data['button'][$key]['name'] = $value['menu_name'];
                $data['button'][$key]['type'] = $type;
                // 判断主菜单的类型
                if ($value['event_type'] == 1) {
                    $data['button'][$key]['url'] = $value['response_url'];
                } else {
                    $data['button'][$key]['key'] = $value['response_keyword'];
                }
            }

        }
        // 封装微信标签id
        $data['matchrule'] = [
            'tag_id' => $tag_id
        ];
        // 刷新并获取授权令牌
        $auth_info = \Wechat::refresh_authorization_info($organization_id);
        // 创建个性化菜单
        $re = \Wechat::create_conditional_menu($auth_info['authorizer_access_token'], $data);
        $re = json_decode($re, true);
        if (!empty($re['menuid'])) {
            return response()->json(['data' => '同步成功！', 'status' => '1']);
        } else {
            return response()->json(['data' => '同步失败！', 'status' => '0']);
        }
    }
    // +----------------------------------------------------------------------
    // | End - 个性化菜单
    // +----------------------------------------------------------------------


    // +----------------------------------------------------------------------
    // | Start - 公共方法
    // +----------------------------------------------------------------------
    /**
     * 获取事件类型
     * @param $eventType
     * @return string
     */
    protected function getEventType($eventType)
    {
        $type = '';
        switch ($eventType) {
            case 1:
                $type = 'view';
                break;
            case 2:
                $type = 'click';
                break;
            case 3:
                $type = 'scancode_push';
                break;
            case 4:
                $type = 'scancode_waitmsg';
                break;
            case 5:
                $type = 'pic_sysphoto';
                break;
            case 6:
                $type = 'pic_photo_or_album';
                break;
            case 7:
                $type = 'pic_weixin';
                break;
            case 8:
                $type = 'location_select';
                break;
        }
        return $type;
    }

    /**
     * 判断菜单是否符合微信公众号标准
     * @param $parent_id
     * @param $type
     * @param $tag_id
     * @return bool|\Illuminate\Http\JsonResponse
     */
    protected function judgeMenuStandard($parent_id, $type = 'defined', $tag_id = '')
    {
        // 获取父级菜单当前个数
        if ($type == 'defined') {
            // 自定义菜单
            $count = WechatDefinedMenu::getCount([['organization_id', $this->admin_data['organization_id']], ['parent_id', $parent_id]]);
        } else {
            // 个性化菜单
            $count = WechatConditionalMenu::getCount([['organization_id', $this->admin_data['organization_id']], ['parent_id', $parent_id], ['tag_id', $tag_id]]);
        }

        // 如果为第一级菜单并且已有的第一级菜单 >= 3 就报错
        if ($parent_id == '0' && $count >= 3) {
            return response()->json(['data' => '主菜单最多只能添加三条', 'status' => '0']);
        }

        // 如果不为第一级菜单并且已有的第一级菜单 >= 5 就报错
        if ($parent_id <> '0' && $count >= 5) {
            return response()->json(['data' => '子菜单只能添加5条', 'status' => '0']);
        }

        // 默认返回true,表示菜单没有问题
        return true;
    }

    // +----------------------------------------------------------------------
    // | End - 公共方法
    // +----------------------------------------------------------------------
}
