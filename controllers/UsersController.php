<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Account;

class UsersController extends Controller
{
    // 展示用户信息
    public function actionShow()
    {
        $query = Account::find();
        $data = $query->orderBy('aid')->asArray()->one();
        $url_appkey = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$data['appid']."&secret=".$data['appsecret'];
        $arr = json_decode(file_get_contents($url_appkey),true);
        $url_token ="https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$arr['access_token'];
        $arr_apk = json_decode(file_get_contents($url_token),true);
        foreach( $arr_apk['data']['openid'] as $key=>$val )
        {
            $url_open[$key] = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$arr['access_token']."&openid=".$val."&lang=zh_CN";
            $arr_open[$key] = json_decode(file_get_contents($url_open[$key]),true);
        }
        return $this -> renderPartial('show',array('arr_open'=>$arr_open));
    }

    //用户自定义请求页面,获取指定用户个人信息
    public function actionUfo()
    {
        $code = empty($_GET['code']) ? NULL : $_GET['code'] ;
        $state =empty($_GET['state']) ? NULL : $_GET['state'] ;
        $query = Account::find();
        $list = $query->orderBy('aid')->where(['atok'=>$state])->asarray()->one();
        $url_utf ="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$list['appid']."&secret=".$list['appsecret']."&code=".$code."&grant_type=authorization_code";
        $str = file_get_contents($url_utf);
        $arr_1 = json_decode($str,true);
        $url_op = "https://api.weixin.qq.com/sns/userinfo?access_token=".$arr_1['access_token']."&openid=".$arr_1['openid']."&lang=zh_CN";
        $list_open = json_decode(file_get_contents($url_op),true);
        return $this -> renderPartial('ufo',array('list_open'=>$list_open));
        // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1bebcfb505f84419&redirect_uri=http%3a%2f%2f123.56.88.15%2ftest%2fsixGroup%2fweb%2findex.php%3fr%3dusers%2fufo&response_type=code&scope=snsapi_userinfo&state=351fq#wechat_redirect
    }
}