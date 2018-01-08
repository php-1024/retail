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
use App\Models\ProgramMenu;
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
                    ErrorLog::addErrorTimes($ip,1);
                    return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
                } elseif($account_info->status=='0'){//查询账号状态
                    ErrorLog::addErrorTimes($ip,1);
                    return response()->json(['data' => '您的账号已被冻结', 'status' => '0']);
                }else {
                    if ($account_info->id <> 1) {//如果不是admin这个超级管理员
                        if($account_info->organization->program_id <> '1'){//如果账号不属于零壹平台管理系统，则报错，不能登陆。1是零壹凭条管理系统的ID
                            ErrorLog::addErrorTimes($ip,1);
                            return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
                        }else{
                            ErrorLog::clearErrorTimes($ip);//清除掉错误记录
                            //插入登录记录
                            if(LoginLog::addLoginLog($account_info['id'],1,$account_info->organization_id,$ip,$addr)) {//写入登陆日志
                                Session::put('zerone_account_id',encrypt($account_info->id));//存储登录session_id为当前用户ID
                                //构造用户缓存数据
                                $admin_data = [
                                    'id'=>$account_info->id,    //用户ID
                                    'account'=>$account_info->account,//用户账号
                                    'is_super'=>$account_info->is_super,//是否超级管理员
                                    'mobile'=>$account_info->mobile,//绑定手机号
                                    'safe_password'=>$account_info->safe_password,//安全密码
                                    'account_status'=>$account_info->status,//用户状态
                                    'ip'=>$ip,//登陆IP
                                    'login_position'=>$addr,//登陆地址
                                    'login_time'=>time()//登陆时间
                                ];
                                $this->create_account_cache($account_info->id,$admin_data);//生成账号数据的Redis缓存
                                $this->create_menu_cache($account_info->id);//生成对应账号的系统菜单
                                return response()->json(['data' => '登录成功', 'status' => '1']);
                            }else{
                                return response()->json(['data' => '登录失败', 'status' => '0']);
                            }
                        }
                    }else{
                        ErrorLog::clearErrorTimes($ip);//清除掉错误记录
                        //插入登录记录
                        if(LoginLog::addLoginLog($account_info['id'],1,0,$ip,$addr)) {//admin,唯一超级管理员，不属于任何组织
                            Session::put('zerone_account_id',encrypt($account_info->id));//存储登录session_id为当前用户ID
                            //构造用户缓存数据
                            $admin_data = [
                                'id'=>$account_info->id,    //用户ID
                                'account'=>$account_info->account,//用户账号
                                'is_super'=>$account_info->is_super,//是否超级管理员
                                'mobile'=>$account_info->mobile,//绑定手机号
                                'ip'=>$ip,//登陆IP
                                'login_position'=>$addr,//登陆地址
                                'login_time'=>time()//登陆时间
                            ];
                            $this->create_account_cache($account_info->id,$admin_data);//生成账号数据的Redis缓存
                            $this->create_menu_cache($account_info->id);//生成对应账号的系统菜单
                            return response()->json(['data' => '登录成功', 'status' => '1']);
                        }else{
                            return response()->json(['data' => '登录失败', 'status' => '0']);
                        }
                    }
                }
            }else{
                ErrorLog::addErrorTimes($ip,1);
                return response()->json(['data' => '登陆账号、手机号或密码输入错误', 'status' => '0']);
            }
        }else{
            return response()->json(['data' => '您短时间内错误的次数超过'.$allowed_error_times.'次，请稍候再尝试登陆 ','status' => '0']);
        }
    }

    //内部方法，生成账号数据Redis缓存
    /*
     * key_id  - 目前以用户ID作为Redis的key的关键字
     * admin_data - 需要缓存的数据
     */
    private function create_account_cache($key_id,$admin_data){
        $admin_data = serialize($admin_data);//序列化数组数据
        Redis::connection('zeo');//连接到我的redis服务器
        $data_key = 'zerone_system_admin_data_'.$key_id;
        Redis::set($data_key,$admin_data);
    }

    //内部方法，生成对应程序及账号的菜单
    /*
     * id - 用户的ID
     */
    private function create_menu_cache($id){
        $menu = ProgramMenu::getList([[ 'parent_id',0],['program_id','1']],0,'id','asc');//获取零壹管理系统的一级菜单
        $son_menu = [];
        foreach($menu as $key=>$val){//获取一级菜单下的子菜单
            $son_menu[$val->id] = ProgramMenu::son_menu($val->id);
        }
        if($id <> 1){
            /**
             * 未完成，这里准备查询用户权限。
             */
        }
        $menu = serialize($menu);
        $son_menu = serialize($son_menu);
        Redis::connection('zeo');//连接到我的redis服务器
        $menu_key = 'zerone_system_menu_'.$id;  //一级菜单的Redis主键。
        $son_menu_key = 'zerone_system_son_menu_'.$id;//子菜单的Redis主键
        Redis::set($menu_key,$menu);
        Redis::set($son_menu_key,$son_menu);
    }
}
?>