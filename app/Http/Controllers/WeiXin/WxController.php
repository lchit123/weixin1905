<?php
namespace App\Http\Controllers\WeiXin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class WxController extends Controller
{
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
     

     public function receiv()
    {
        $log_file = "wx.log";       // public
        //将接收的数据记录到日志文件
        $xml_str = file_get_contents("php://input");
        $data = date('Y-m-d H:i:s')  . ">>>>>>\n" . $xml_str . "\n\n";
        file_put_contents($log_file,$data,FILE_APPEND);     //追加写
        //处理xml数据
        $xml_obj = simplexml_load_string($xml_str);
        // 判断消息类型
        $msg_type = $xml_obj->MsgType;
        $touser = $xml_obj->FromUserName;       //接收消息的用户openid
        $fromuser = $xml_obj->ToUserName;       // 开发者公众号的 ID
        $time = time();
        if($msg_type=='text'){
            $content = date('Y-m-d H:i:s') . $xml_obj->Content;
            $response_text = '<xml>
  <ToUserName><![CDATA['.$touser.']]></ToUserName>
  <FromUserName><![CDATA['.$fromuser.']]></FromUserName>
  <CreateTime>'.$time.'</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA['.$content.']]></Content>
</xml>';
            echo $response_text;            // 回复用户消息
        }
    }
    /**
     * 获取用户基本信息
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