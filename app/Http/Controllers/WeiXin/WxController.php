<?php
namespace App\Http\Controllers\WeiXin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WxUserModel;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
 
class WxController extends Controller
{ 
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










}