<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Session;

class LoginController extends Controller{
    /*
     * 登陆页面
     */
    public function display()
    {
        //echo assets('public/dashboard/library/bootstrap/test.js');
        return view('dashboard/login/display');

    }
    /*
     * 生成验证码
     */
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
?>