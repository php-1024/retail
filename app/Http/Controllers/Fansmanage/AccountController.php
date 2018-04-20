<?php

/**
 * 账号中心 模块，包括：
 *   用户信息，密码，安全密码 创建和修改
 */

namespace App\Http\Controllers\Fansmanage;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountInfo;
use App\Models\Module;
use App\Models\OperationLog;
use App\Models\OrganizationStoreinfo;
use App\Models\ProgramModuleNode;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AccountController extends Controller
{
    /**
     * 账号信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();
        // 如果是超级管理员，获取账号信息
        if ($admin_data['is_super'] == 2) {
            $user = Account::getOne([['id', 1]]);
        } else {
            $user = Account::getOne([['id', $admin_data['id']]]);
        }
        // 获取权限节点的部分：
        // 获取一级账号id
        $account_id = Account::getPluck([['organization_id', $admin_data['organization_id']], ['parent_id', 1]], 'id')->first();
        // 判断是否处于一级账号状态
        if ($account_id == $admin_data['id']) {
            // 获取当前系统的所有模块和节点
            $module_node_list = Module::getListProgram(3, [], 0, 'id');
        } else {
            // 获取当前用户具有权限的节点
            $account_node_list = ProgramModuleNode::getAccountModuleNodes(3, $admin_data['id']);
            $modules = [];
            $nodes = [];
            $module_node_list = [];
            // 过滤重复选出的节点和模块
            foreach ($account_node_list as $key => $val) {
                $modules[$val->module_id] = $val->module_name;
                $nodes[$val->module_id][$val->node_id] = $val->node_name;
            }
            // 遍历，整理为合适的格式
            foreach ($modules as $key => $val) {
                $module = ['id' => $key, 'module_name' => $val];
                foreach ($nodes[$key] as $k => $v) {
                    $module['program_nodes'][] = array('id' => $k, 'node_name' => $v);
                }
                $module_node_list[] = $module;
                unset($module);
            }
        }
        // 渲染页面
        return view('Fansmanage/Account/profile', ['user' => $user, 'module_node_list' => $module_node_list, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }


    /**
     * 修改个人信息提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();

        // 手机号码
        $mobile = $request->input('mobile');
        // 真实姓名
        $realname = $request->input('realname');
        // 用户id
        $id = $request->input('id');

        // 获取组织id
        $organization_id = $request->input('organization_id');
        // 获取账户信息
        if ($admin_data['is_super'] == 2) {
            $oneAcc = Account::getOne([['id', 1]]);
        } else {
            $oneAcc = Account::getOne([['id', $id]]);
        }

        // 事务处理
        DB::beginTransaction();
        try {
            // 判断手机号码是否发生改变
            if ($oneAcc['mobile'] != $mobile) {
                // 判断手机号在店铺存不存在
                if (Account::checkRowExists([['mobile', $mobile], ['organization_id', $organization_id]])) {
                    return response()->json(['data' => '手机号已存在', 'status' => '0']);
                }
                // 判断手机号码是否超级管理员手机号码一致
                if ($admin_data['is_super'] != 2) {
                    if (Account::checkRowExists([['organization_id', '0'], ['mobile', $mobile]])) {
                        return response()->json(['data' => '手机号码已存在', 'status' => '0']);
                    }
                    // 修改店铺表店铺手机号码
                    OrganizationStoreinfo::editOrganizationStoreinfo([['organization_id', $organization_id]], ['store_owner_mobile' => $mobile]);
                }
                // 修改用户管理员信息表 手机号
                Account::editAccount(['organization_id' => $organization_id], ['mobile' => $mobile]);
            }


            // 判断姓名是否发生改变
            if ($oneAcc['account_info']['realname'] != $realname) {
                // 判断真实姓名是否超级管理员真实姓名一致
                if ($admin_data['is_super'] != 2) {
                    // 修改店铺用户信息表 用户姓名
                    OrganizationStoreinfo::editOrganizationStoreinfo([['organization_id', $organization_id]], ['store_owner' => $realname]);
                }
                // 修改用户管理员信息表 用户名
                AccountInfo::editAccountInfo([['account_id', $id]], ['realname' => $realname]);
            }

            // 真实姓名
            $admin_data['realname'] = $realname;
            // 手机号码
            $admin_data['mobile'] = $mobile;

            // 保存操作记录
            if ($admin_data['is_super'] == 2) {
                OperationLog::addOperationLog('3', '1', '1', $route_name, '在店铺系统修改了个人信息');
            } else {
                // 将账号信息保存到redis 中，生成账号数据的Redis缓存-店铺
                \ZeroneRedis::create_catering_account_cache($admin_data['id'], $admin_data);
                // 保存操作记录
                OperationLog::addOperationLog('3', $organization_id, $id, $route_name, '修改了个人信息');
            }
            DB::commit();
        } catch (\Exception $e) {
            // 事件回滚
            DB::rollBack();
            return response()->json(['data' => '个人信息修改失败，请检查', 'status' => '0']);
        }
        // 返回提示
        return response()->json(['data' => '个人信息修改成功', 'status' => '1']);
    }

    /**
     * 修改安全密码
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function safe_password(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();

        $id = $admin_data['id'];
        // 获取账号信息
        if ($admin_data['is_super'] == 2) {
            $oneAcc = Account::getOne([['id', 1]]);
        } else {
            $oneAcc = Account::getOne([['id', $id]]);
        }
        // 渲染页面
        return view('Fansmanage/Account/safe_password', ['oneAcc' => $oneAcc, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);
    }

    /**
     * 修改安全密码提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function safe_password_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 是否修改安全密码，还是创建安全密码
        $is_editing = $request->input('is_editing');
        // 原安全密码
        $old_safe_password = $request->input('old_safe_password');
        // 新安全密码
        $safe_password = $request->input('safe_password');

        // 获取加密盐
        if ($admin_data['is_super'] == 2) {
            $key = config("app.zerone_safe_encrypt_key");
        } else {
            $key = config("app.fansmanage_safe_encrypt_key");
        }

        // 获取加密后的数据
        $encryptPwd = $this->encrypt($safe_password, $key);
        // 获取原加密后的数据
        $old_encryptPwd = $this->encrypt($old_safe_password, $key);

        // 判断是创建密码还是修改密码 1:创建密码 -1:修改密码
        if ($is_editing == '-1') {
            // 事务处理
            DB::beginTransaction();
            try {
                $admin_data['safe_password'] = $encryptPwd;
                // 判断是不是超级管理员
                if ($admin_data['is_super'] == 2) {
                    // 编辑安全密码
                    Account::editAccount([['id', 1]], ['safe_password' => $encryptPwd]);
                    // 在零壹保存操作记录
                    OperationLog::addOperationLog('1', '1', '1', $route_name, '在粉丝管理系统设置了安全密码');
                    // 生成账号数据的Redis缓存
                    ZeroneRedis::create_fansmanage_account_cache(1, $admin_data);
                } else {
                    // 编辑安全密码
                    Account::editAccount([['id', $admin_data['id']]], ['safe_password' => $encryptPwd]);
                    // 保存操作记录
                    OperationLog::addOperationLog('3', $admin_data['organization_id'], $admin_data['id'], $route_name, '设置了安全密码');
                    // 生成账号数据的Redis缓存
                    ZeroneRedis::create_fansmanage_account_cache($admin_data['id'], $admin_data);
                }
                DB::commit();
            } catch (\Exception $e) {
                // 事件回滚
                DB::rollBack();
                return response()->json(['data' => '设置安全密码失败，请检查', 'status' => '0']);
            }
            return response()->json(['data' => '安全密码设置成功', 'status' => '1']);
        } else {
            // 修改安全密码
            if ($admin_data['safe_password'] == $old_encryptPwd) {
                // 事务处理
                DB::beginTransaction();
                try {
                    $admin_data['safe_password'] = $encryptPwd;
                    // 判断是不是超级管理员
                    if ($admin_data['is_super'] == 2) {
                        // 编辑安全密码
                        Account::editAccount([['id', 1]], ['safe_password' => $encryptPwd]);
                        // 在零壹保存操作记录
                        OperationLog::addOperationLog('1', '1', '1', $route_name, '在粉丝管理系统修改了安全密码');
                        // 生成账号数据的Redis缓存
                        ZeroneRedis::create_fansmanage_account_cache(1, $admin_data);
                    } else {
                        // 编辑安全密码
                        Account::editAccount([['id', $admin_data['id']]], ['safe_password' => $encryptPwd]);
                        // 保存操作记录
                        OperationLog::addOperationLog('4', $admin_data['organization_id'], $admin_data['id'], $route_name, '修改了安全密码');
                        // 生成账号数据的Redis缓存
                        ZeroneRedis::create_fansmanage_account_cache($admin_data['id'], $admin_data);
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    // 事件回滚
                    DB::rollBack();
                    return response()->json(['data' => '安全密码修改失败，请检查', 'status' => '0']);
                }
                // 返回提示
                return response()->json(['data' => '安全密码修改成功！', 'status' => '1']);
            } else {
                return response()->json(['data' => '原安全密码不正确！', 'status' => '0']);
            }
        }
    }

    /**
     * 修改登入密码显示页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password(Request $request)
    {
        //中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        //中间件产生的菜单数据参数
        $menu_data = $request->get('menu_data');
        //中间件产生的子菜单数据参数
        $son_menu_data = $request->get('son_menu_data');
        //获取当前的页面路由
        $route_name = $request->path();

        $id = $admin_data['id'];
        // 获取账号信息
        if ($admin_data['is_super'] == 2) {
            $oneAcc = Account::getOne([['id', 1]]);
        } else {
            $oneAcc = Account::getOne([['id', $id]]);
        }
        // 渲染页面
        return view('Fansmanage/Account/password', ['oneAcc' => $oneAcc, 'admin_data' => $admin_data, 'route_name' => $route_name, 'menu_data' => $menu_data, 'son_menu_data' => $son_menu_data]);

    }

    /**
     * 修改登入密码功能提交
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function password_check(Request $request)
    {
        // 中间件产生的管理员数据参数
        $admin_data = $request->get('admin_data');
        // 获取当前的页面路由
        $route_name = $request->path();
        // 获取修改登入密码的id
        $id = $request->input('id');
        // 获取用户信息
        $account = Account::getOne([['id', $id]]);
        // 原密码
        $old_password = $request->input('old_password');
        // 新密码
        $password = $request->input('password');

        // 获取加密盐
        if ($admin_data['is_super'] == 2) {
            $key = config("app.zerone_encrypt_key");
        } else {
            $key = config("app.fansmanage_encrypt_key");
        }

        // 将密码进行加密处理
        $encryptPwd = $this->encrypt($password, $key);
        $old_encryptPwd = $this->encrypt($old_password, $key);

        // 判断密码是否正确
        if ($account['password'] == $old_encryptPwd) {
            DB::beginTransaction();
            try {
                // 编辑安全密码
                Account::editAccount([['id', $id]], ['password' => $encryptPwd]);
                // 保存操作记录
                if ($admin_data['is_super'] == 2) {
                    OperationLog::addOperationLog('1', '1', $id, $route_name, '在粉丝管理系统修改了登录密码');
                } else {
                    OperationLog::addOperationLog('3', $admin_data['organization_id'], $id, $route_name, '修改了登录密码');
                }
                DB::commit();
            } catch (\Exception $e) {
                // 事件回滚
                DB::rollBack();
                return response()->json(['data' => '修改登录密码失败，请检查', 'status' => '0']);
            }
            // 返回提示
            return response()->json(['data' => '登录密码修改成功！', 'status' => '1']);
        } else {
            return response()->json(['data' => '原密码不正确！', 'status' => '0']);
        }
    }

    /**
     * 加密盐
     * @param $password
     * @param $key
     * @param $encrypt_code
     * @return string
     */
    private function encrypt($password, $key, $encrypt_code = 'lingyikeji')
    {
        // 加密密码第一重
        $old_encrypted = md5($password);
        // 加密密码第二重
        $old_encryptPwd = md5("{$encrypt_code}{$old_encrypted}{$key}");
        // 返回加密后字符串
        return $old_encryptPwd;
    }
}