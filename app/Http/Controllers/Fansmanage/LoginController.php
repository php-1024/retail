<?php
/**
 * 粉丝管理系统登录体系
 */
namespace App\Http\Controllers\Fansmanage;

use App\Http\Controllers\Controller;
use App\Services\ZeroneRedis\ZeroneRedis;
use Illuminate\Support\Facades\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Models\Account;
use App\Models\ErrorLog;
use App\Models\LoginLog;
use Session;

class LoginController extends Controller
{
    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display()
    {
        // 渲染页面
        return view('Fansmanage/Login/display');
    }

    /**
     * 生成验证码
     */
    public function captcha()
    {
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        // 可以设置图片宽高及字体
        $builder->build($width = 150, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        Session::flash('fansmanage_system_captcha', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /**
     * 检测登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function login_check()
    {
        // 获取访问者IP
        $ip = Request::getClientIp();
        // 获取访问者地址
        $addr_arr = \IP2Attr::find($ip);
        // 获取访问者地址
        $addr = $addr_arr[0] . $addr_arr[1] . $addr_arr[2] . $addr_arr[3];
        // IP查询完地址后转化为整型。便于存储和查询
        $ip = ip2long($ip);
        // 允许登录错误次数
        $allowed_error_times = config("app.allowed_error_times");
        // 接收用户名
        $username = Request::input('username');
        // 接收用户密码
        $password = Request::input('password');
        // 根据账号查询
        $account_info = Account::getOneForLogin($username);
        // 实例化错误记录表模型:
        // 查询该IP下的错误记录
        $error_log = ErrorLog::getOne([['ip', $ip]]);

        // 如果登录失败超过多少次，就需要停止10分钟，才能再次进行登录：

        // 如果没有错误记录 或 错误次数小于允许错误的最大次数 或 错误次数超出 但时间已经过了10分钟
        if (empty($error_log) || $error_log['error_time'] < $allowed_error_times || (strtotime($error_log['error_time']) >= $allowed_error_times && time() - strtotime($error_log['updated_at']) >= 600)) {

            if (!empty($account_info)) {
                // 获取加密盐
                if ($account_info->id == 1) {
                    $key = config("app.zerone_encrypt_key");
                } else {
                    $key = config("app.fansmanage_encrypt_key");
                }

                // 加密密码第一重
                $encrypted = md5($password);
                // 加密密码第二重
                $encryptPwd = md5("lingyikeji" . $encrypted . $key);

                // 登录信息验证
                if ($encryptPwd != $account_info->password) {
                    // 判断密码是否正确，不正确就进行错误记录
                    ErrorLog::addErrorTimes($ip, 3);
                    return response()->json(['data' => '登录账号、手机号或密码输入错误', 'status' => '0']);

                } else if ($account_info->status <> '1') {
                    // 判断账号状态，是否处于冻结状态
                    ErrorLog::addErrorTimes($ip, 3);
                    return response()->json(['data' => '您的账号状态异常，请联系管理员处理', 'status' => '0']);
                } else {

                    // 登录成功要生成缓存的登录信息
                    $admin_data = [
                        // 用户ID
                        'id' => $account_info->id,
                        // 用户账号
                        'account' => $account_info->account,
                        // 组织ID
                        'organization_id' => $account_info->organization_id,
                        // 是否超级管理员
                        'is_super' => $account_info->is_super,
                        // 上级ID
                        'parent_id' => $account_info->parent_id,
                        // 上级树
                        'parent_tree' => $account_info->parent_tree,
                        // 账号在组织中的深度
                        'deepth' => $account_info->deepth,
                        // 绑定手机号
                        'mobile' => $account_info->mobile,
                        // 安全密码
                        'safe_password' => $account_info->safe_password,
                        // 用户状态
                        'account_status' => $account_info->status,
                        // 登录IP
                        'ip' => $ip,
                        // 登录地址
                        'login_position' => $addr,
                        // 登录时间
                        'login_time' => time()
                    ];

                    // 如果不是admin这个超级管理员
                    if ($account_info->id <> 1) {

                        // 如果账号不属于粉丝管理系统，则报错，不能登录。  7、是粉丝管理系统的ID
                        if ($account_info->organization->program_id <> '3') {
                            // 记录错误数据
                            ErrorLog::addErrorTimes($ip, 3);
                            return response()->json(['data' => '登录账号、手机号或密码输入错误', 'status' => '0']);
                        } else {
                            // 清除掉错误记录
                            ErrorLog::clearErrorTimes($ip);
                            // 插入登录记录
                            if (LoginLog::addLoginLog($account_info['id'], 3, $account_info->organization_id, $ip, $addr)) {
                                // 存储登录session_id为当前用户ID
                                Session::put('fansmanage_account_id', encrypt($account_info->id));

                                // 构造用户缓存数据：

                                // 用户的真实姓名
                                if (!empty($account_info->account_info->realname)) {
                                    $admin_data['realname'] = $account_info->account_info->realname;
                                } else {
                                    $admin_data['realname'] = '未设置';
                                }
                                // 用户的角色分配名 : 判断是否存在账户全新信息
                                if (!empty($account_info->account_roles) && $account_info->account_roles->count() != 0) {
                                    foreach ($account_info->account_roles as $key => $val) {
                                        $account_info->role = $val;
                                    }
                                    $admin_data['role_name'] = $account_info->role->role_name;
                                } else {
                                    $admin_data['role_name'] = '角色未设置';
                                }

                                // 生成账号数据的Redis缓存，账号信息
                                ZeroneRedis::create_fansmanage_account_cache($account_info->id, $admin_data);
                                // 生成对应账号的商户系统菜单，左侧的菜单
                                ZeroneRedis::create_menu_cache($account_info->id, 3);
                                // 返回提示
                                return response()->json(['data' => '登录成功', 'status' => '1']);
                            } else {
                                return response()->json(['data' => '登录失败', 'status' => '0']);
                            }
                        }
                    } else {
                        // 是超级管理员的情况下：
                        // 清除掉错误记录
                        ErrorLog::clearErrorTimes($ip);
                        // 存储登录session_id为当前用户ID
                        Session::put('fansmanage_account_id', encrypt($account_info->id));
                        $admin_data['realname'] = '系统管理员';
                        $admin_data['role_name'] = '系统管理员';
                        // 构造用户缓存数据:
                        // 生成账号数据的Redis缓存
                        ZeroneRedis::create_fansmanage_account_cache($account_info->id, $admin_data);
                        // 生成对应账号的商户系统菜单
                        ZeroneRedis::create_menu_cache($account_info->id, 3);
                        // 返回提示
                        return response()->json(['data' => '登录成功', 'status' => '1']);
                    }
                }
            } else {
                // 记录错误数据
                ErrorLog::addErrorTimes($ip, 3);
                return response()->json(['data' => '登录账号、手机号或密码输入错误', 'status' => '0']);
            }

        } else {
            // 返回错误提示
            return response()->json(['data' => '您短时间内错误的次数超过' . $allowed_error_times . '次，请稍候再尝试登录 ', 'status' => '0']);
        }
    }
}