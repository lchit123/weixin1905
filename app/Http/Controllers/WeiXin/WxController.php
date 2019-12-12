<?php
namespace App\Http\Controllers\WeiXin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class WxController extends Controller
{
    // protected $access_token;
    // public function __construct()
    // {
    //     //获取 access_token
    //     $this->access_token = $this->getAccessToken();
    // }
    // protected function getAccessToken()
    // {
    //     $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('APPID').'&secret='.env('APPSECRET');
    //     $data_json = file_get_contents($url);
    //     $arr = json_decode($data_json,true);
    //     return $arr['access_token'];
    // }
    /**
     * 处理接入
     */
    public function wechat()
    {
        $token = 'abc123token';       //开发提前设置好的 token
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){        //验证通过
            echo $echostr;
        }else{
            die("not ok");
        }
    }
    /**
     * 接收微信推送事件
     */
     
    public function getUserInfo($access_token,$openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        //发送网络请求
        $json_str = file_get_contents($url);
        $log_file = 'wx_user.log';
        file_put_contents($log_file,$json_str,FILE_APPEND);
    }
}