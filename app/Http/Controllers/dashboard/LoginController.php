<?php
/**
 *新版本登陆界面
 *
 **/
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Crypt;
use Session;

class LoginController extends Controller{
    /*
     * 登陆页面
     */
    public function display()
    {

        //$encrypted = Crypt::encryptString('Hello world.');
        //$decrypted = Crypt::decryptString($encrypted);
        //echo $decrypted;

        $data['random']=time();
        return view('dashboard/login/display',$data);

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
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
?>