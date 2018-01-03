<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\Zerone;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Models\Account;
use App\Models\ErrorLog;
use App\Models\LoginLog;
use Session;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller{
    /*
     * 登陆页面
     */
    public function display()
    {
        return view('Zerone/Login/display');
    }
    /*
     * 生成验证码
     */
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 150, $height = 35, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('zerone_system_captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    //检测登录
    public function login_check(){
        $ip = Request::getClientIp();//获取访问者IP
        $addr_arr = \IP2Attr::find($ip);//获取访问者地址
        $addr = $addr_arr[0].$addr_arr[1].$addr_arr[2].$addr_arr[3];//获取访问者地址
        $ip = ip2long($ip);//IP查询完地址后转化为整型。便于存储和查询
        $allowed_error_times = config("app.allowed_error_times");//允许登录错误次数
        $username = Request::input('username');//接收用户名
        $password = Request::input('password');//接收用户密码
        $key = config("app.zerone_encrypt_key");//获取加密盐
        $encrypted = md5($password);//加密密码第一重
        $encryptPwd = md5("lingyikeji".$encrypted.$key);//加密密码第二重

        //实例化错误记录表模型
        $error_log = ErrorLog::getOne([['ip',$ip]]);//查询该IP下的错误记录
        //如果没有错误记录 或 错误次数小于允许错误的最大次数 或 错误次数超出 但时间已经过了10分钟
        if(empty($error_log) || $error_log['error_time'] <  $allowed_error_times || (strtotime($error_log['error_time']) >= $allowed_error_times && time()-strtotime($error_log['updated_at']) >= 600)) {
            if($account_info = Account::getOneForLogin($username)){
                if ($encryptPwd != $account_info->password) {//查询密码是否对的上
                    ErrorLog::addErrorTimes($ip);
                    return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
                } elseif($account_info->status=='0'){//查询账号状态
                    ErrorLog::addErrorTimes($ip);
                    return response()->json(['data' => '您的账号已被冻结', 'status' => '0']);
                }else {
                    if ($account_info->id <> 1) {//如果不是admin这个超级管理员
                        if($account_info->program_id!='1'){//如果账号不属于零壹平台管理系统，则报错，不能登陆。1是零壹凭条管理系统的ID
                            ErrorLog::addErrorTimes($ip);
                            return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
                        }
                    }
                    ErrorLog::clearErrorTimes($ip);//清除掉错误记录
                    //插入登录记录
                    if(LoginLog::addLoginLog($account_info['id'],$ip,$addr)) {
                        Session::put('tooling_account_id',encrypt($account_info['id']));//存储登录session_id为当前用户ID
                        //构造用户缓存数据
                        $admin_data = ['admin_id'=>$account_info['id'],'admin_account'=>$account_info['account'],'admin_is_super'=>$account_info['is_super'],'admin_login_ip'=>$ip,'admin_login_position'=>$addr,'admin_login_time'=>time()];
                        $admin_data = serialize($admin_data);
                        Redis::connection('zeo');//连接到我的redis服务器
                        $data_key = 'tooling_system_admin_data_'.$account_info['id'];
                        Redis::set($data_key,$admin_data);
                        return response()->json(['data' => '登录成功', 'status' => '1']);
                    }else{
                        return response()->json(['data' => '登录失败', 'status' => '0']);
                    }
                }
            }else{
                ErrorLog::addErrorTimes($ip);
                return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
            }
        }else{
            return response()->json(['data' => '您短时间内错误的次数超过'.$allowed_error_times.'次，请稍候再尝试登陆 ','status' => '0']);
        }
    }



}
?>