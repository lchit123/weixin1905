<?php
namespace App\Http\Controllers\WeiXin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WxUserModel;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
 
class WxController extends Controller
{ 

  public function __construct()
  { 
    //获取access_token
    $this->access_token=$this->getAccessToken();

  }

  protected function getAccessToken()
  { 

    $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=. ).&secret=env(' 

  }

 //处理接入
  public function wechat()
  { 
    $token='abc123token';//设置好的token
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    $echostr=$_GET["echostr"];
    
     
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $tmpStr == $signature ){   //验证通过
        echo $echostr;
    }else{
        die("not ok");
    }


  }

  public function receiv()
  { 
    $log_file="wx.log";
    //将接收的数据记录到日志文件中
    $xml_str=file_get_contents("php://input");
    $data=date('Y-m-d H:i:s').$xml;
    file_put_contents($log_file,$data,FILE_APPEND);   //追加写日志

    //处理xml数据
    $xml_arr=simplexml_load_string($xml_str);
    $event=$xml_obj->Event;   //获取事件类型
    $openid=$xml_obj->FromUserName;  //获取用户的openid
    if($event=='subscribe'){ 
      //获取用户信息
      $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

    }
  }



//获取用户基本信息
  public function getUserInfo()
  { 

    $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';
    //发送网络请求
    $json_str=file_get_contents($url);
    $log_file='wx_user.log';
    file_put_contents($log_file,$json_str,FILE_APPEND);

  }

}