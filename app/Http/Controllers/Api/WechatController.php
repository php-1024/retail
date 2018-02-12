<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WechatOpenSetting;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
        echo "这里是消息与事件接收URL";
    }
    //接受收授权推送消息。
    public function open(Request $request){
        $timeStamp    =$_GET['timestamp'];
        $nonce        =$_GET['nonce'];
        $encrypt_type =$_GET['encrypt_type'];
        $msg_sign     =$_GET['msg_signature'];
        $encryptMsg   =file_get_contents('php://input');
        //file_put_contents('testopen.txt',$timeStamp.'|'.$nonce.'|'.$encrypt_type.'|'.$msg_sign.'|'.$encryptMsg);
        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }

    //授权链接
    public function auth(){
        $url = \Wechat::get_auth_url();
        echo "<a href='".$url."'>授权入口</a>";
        //header('location:'.$url);
    }

    //授权回调链接
    public function redirect(){
        $auth_code = $_GET['auth_code'];//授权码
        $expires_in = $_GET['expires_in'];//过期时间
        $auth_info = \Wechat::get_authorization_info($auth_code,1);//获取授权
        //添加所有的已有粉丝进入零壹账号体系,明天再做。

    }
}
?>