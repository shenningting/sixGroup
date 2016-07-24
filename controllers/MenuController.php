<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\Account;
use yii\data\Pagination;

class MenuController extends Controller
{
    /*
     *  加载菜单页面
     */
    public function actionMenu()
    {
        if(\Yii::$app->request->isPost){
           // print_r(\Yii::$app->request->post());die;
            $model =new Menu();
            $model->attributes=\Yii::$app->request->post();
            if($model->insert()){
                echo "ok";
            }
        }
        $account_data = Account::find() -> select('aname,aid') -> asArray() ->all();
        return $this -> renderPartial('menu',['account_data'=>$account_data]);
    }

    /*
     *  主菜单
     */
    public function actionMain_menu()
    {
        if(\Yii::$app->request->isPost){
            $num = Menu::find()-> where(['mgrade'=>0]) -> andWhere(['aid'=>\Yii::$app->request->post('aid')]) -> count();
            if($num >= 3){
                echo "<script>alert('此公众号已有三个主菜单，差不多就行了');location.href='index.php?r=menu/main_menu'</script>";
                die;
            }
            $model =new Menu();
            $model->attributes=\Yii::$app->request->post();
            $model -> mgrade = '0';
            if($model->insert()){
                echo "ok";
            }
        }else{
            $account_data = Account::find() -> select('aname,aid') -> asArray() ->all();
            return $this -> renderPartial('main_menu',['account_data'=>$account_data]);
        }
    }

    /*
     * ajax 请求
    */
    public function actionG_change()
    {
        $aid = \Yii::$app->request->get('aid');
        $main_data  = Menu::find()-> where(['mgrade'=>0]) -> andWhere(['aid'=>$aid]) -> asArray() ->all();
        $main_data = Json_encode($main_data);
        echo $main_data;

    }

     /*
     * 执行入库
     */
    public function actionAddword()
    {
        $reply = new Reply();
        $reply -> retype = 1;
        $reply -> attributes = \Yii::$app -> request -> post();
        if($reply->insert()){
            $reid = $reply->attributes['reid'];
            $trcontent = \Yii::$app -> request -> post('trcontent');
            foreach($trcontent as $v){
                $textreply = new TextReply();
                $textreply -> reid = $reid;
                $textreply -> trcontent = $v;
                $bool = $textreply->insert();
            }
            if($bool){
                echo "ok";
            }
        }else{
            $error_data = $reply -> getErrors();
            $this -> renderPartial('word',['error_data'=>$error_data]);
            $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$Accesstoken;
            /* $url ="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$Accesstoken;
              return file_get_contents($url);*/
        }
    }

    private function getAccesstoken($appid,$app){
        //return "aaa";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$app";
        $file=file_get_contents($url);
        $arr=json_decode($file,true);
        $Accesstoken=$arr['access_token'];
        return $Accesstoken;
    }

	/*
	    文字回复规则管理
	*/
	public function actionGo()
	{
        $account_data = Account::find() -> select('aname,aid') -> asArray() ->all();
        $result = Menu::find() -> where(['mgrade'=>0]) -> asArray()-> all();
        foreach($result as $k=>$v){
            $result1 = Menu::find() -> where(['mgrade'=>$v['mid']]) -> asArray() -> all();
            $data1[$k]['main'] = $v['mname'];
            $data1[$k]['aid'] = $v['aid'];
            $data1[$k]['brother'] = $result1;
        }
        $data['account_data'] = $account_data;
        $data['data1'] = $data1;
       // print_r($data);die;
        return $this -> renderPartial('show',['data'=>$data]);
	}

    public function actionSheng()
    {
        $aid = \Yii::$app->request->get('aid');
        $result = Menu::find() -> where(['mgrade'=>0]) ->andWhere(['aid'=>$aid]) -> asArray()-> all();
        foreach($result as $k=>$v){
            $result1 = Menu::find() -> where(['mgrade'=>$v['mid']]) -> asArray() -> all();
            $data1[$k]['main'] = $v['mname'];
            $data1[$k]['aid'] = $v['aid'];
            $data1[$k]['brother'] = $result1;
        }
        $result = Account::find() ->andWhere(['aid'=>$aid]) -> asArray()-> one();
        $Accesstoken=$this->getAccesstoken($result['appid'],$result['appsecret']);
        $url ="https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$Accesstoken;
        file_get_contents($url);
       // echo $Accesstoken;die;
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$Accesstoken;

        $str = '';
    foreach($data1 as $val) {
        $str .= '{';
        $str .= '"name":"'.$val['main'].'",';
        $str .= '"sub_button":[';
        foreach ($val['brother'] as $v) {
            $str .= '{';
            $str .= '"type":"view",';
            $str .= '"name":"'.$v['mname'].'",';
            $str .= '"url":"http://www.soso.com/"';
            $str .= '},';
        }
        $str .= ']';
        $str .= '}';
    }
        $data = '{
         "button":[
         {
              "type":"click",
              "name":"看天气",
              "key":"V1001_TODAY_MUSIC"
          },
          '.$str.'
          ]
    }';
        $html=$this->curlPost($url,$data,'POST');
        var_dump($html);
    }

    public function curlPost($url,$data,$method){
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
}