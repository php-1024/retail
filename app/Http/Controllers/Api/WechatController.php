<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WechatOpenSetting;

class WechatController extends Controller{
    public function response($appid,Request $request){
        dump($appid);
        //\Wechat::getVerify_Ticket();
        WechatOpenSetting::editComponentVerifyTicket(123,time());
        echo "这里是消息与事件接收URL";
    }

    public function open(Request $request){
        //file_put_contents('testopen.txt','123456');

        //$timeStamp    =$_GET['timestamp'];
        //$nonce        =$_GET['nonce'];
        //$encrypt_type =$_GET['encrypt_type'];
        //$msg_sign     =$_GET['msg_signature'];
        //$encryptMsg   =file_get_contents('php://input');
        //file_put_contents('testopen.txt',$timeStamp.'|'.$nonce.'|'.$encrypt_type.'|'.$msg_sign.'|'.$encryptMsg);
        $timeStamp = '1518321601';
        $nonce='172063435';
        $encrypt_type='aes';
        $msg_sign='4e868c20679a2eafb6a038440a54c5c569ed27e5';

        $encryptMsg='<xml>
    <AppId><![CDATA[wxd22806e3df9e9d35]]></AppId>
    <Encrypt><![CDATA[VYY3TuOs0ol05otVJ/s846BEd32KSsJ6/8y30WtC4+CKtHqgK/+MHukGbFV9GGmfad6kORitcvy94ft0bW85mA3hHSMCpeX9fXCtOW8d8c1WOxF2HFr2eWcgziihjCMZOuZxwqSIJg0cz+KqfTolGVxNQAdcYyVcbSTZcsh5A2b/PaG1VZ2vYN+v3zOE8/RKz36JjI6D+zYaChmFc2qTgrIrp+triY1AYedqXNFOr5W5EiSN/8fGDk4mKSLDwy4y47gnC0n/h5z2f/gV5vC/dCI/RfbYrxCy3oz7VQvZ5G4CV1xoXZgsKnoFi3CO5i08d0eafVvmbYFrSXs8YHix1GNiueFDD9DJoKjyzGbzdAg2cp7otqS46JqA4noWnzGfpexDxo5OD9pQ0qsZOsdRM/vLbeI38WOulnpuqlDwSxFqrKhPpMmyrVwCFZHqz0SqaXlbiRovlywA4U49ToP14g==]]></Encrypt>
</xml>';
        $result = \Wechat::getVerify_Ticket($timeStamp,$nonce,$encrypt_type,$msg_sign,$encryptMsg);
        if($result){
            ob_clean();
            echo "success";
        }
    }
}
?>