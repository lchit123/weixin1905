<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

/*Route::get('weixin/test','Wechat\WechatController@test');
Route::get('weixin/index','Wechat\WechatController@checkSignature');//处理接入请求
Route::post('weixin/index','Wechat\WechatController@receiv');         //接收微信的推送事件
Route::get('weixin/media','Wechat\WechatController@getMedia');         //获取临时素材
Route::get('/weixin/flush/access_token','Wechat\WechatController@flushAccessToken');        //刷新access_token
*/


// Route::get('/wx/test','WeiXin\WxController@test');
// Route::get('/wx','WeiXin\WxController@wechat');
// Route::post('/wx','WeiXin\WxController@receiv');        //接收微信的推送事件
// Route::get('/wx/media','WeiXin\WxController@getMedia');        //获取临时素材
// Route::get('/wx/flush/access_token','WeiXin\WxController@flushAccessToken');        //刷新access_token
// Route::get('/wx/menu','WeiXin\WxController@createMenu');        //创建菜单
// Route::get('/wx/test','WeiXin\WxController@test');  
//       //创建菜单
 Route::get('/test/xml','Test\TestController@xmlTest');




 //微信开发
 Route::get('/wx','WeiXin\WxController@wechat');
 Route::post('/wx','WeiXin\WxController@receiv'); //接收微信回调信息