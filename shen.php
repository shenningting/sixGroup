<?php
/**
 * wechat php test
 */

$str=$_GET['gui'];
include_once("./web/assets/abc.php");
$pdo ->query("set names utf8");
$rs = $pdo->query("SELECT * FROM we_account where atok ='$str'");
$result_arr = $rs->fetchAll();
//print_r($result_arr);die;
foreach($result_arr as $val){
    $aid = $val['aid'];
    $token=$val['atoken'];
    $appid = $val['appid'];
    $appsecret = $val['appsecret'];
}
header('content-type:text');
//define your token
define("AID",$aid);
define("TOKEN",$token);
define("APPID",$appid);
define("APPSECRET",$appsecret);
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($pdo);

class wechatCallbackapiTest
{
    public function valid($pdo)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        //echo $this->getAccesstoken();
        if($this->checkSignature()){
            echo $echoStr;
            $this->responseMsg($pdo);
            exit;
        }
    }

    public function responseMsg($pdo)
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $msgtype = $postObj->MsgType;
            $toUsername = $postObj->ToUserName;
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            $imageTpl = " <xml>
                            <ToUserName><![CDATA[toUser]]></ToUserName>
                            <FromUserName><![CDATA[fromUser]]></FromUserName>
                            <CreateTime>12345678</CreateTime>
                            <MsgType><![CDATA[image]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[media_id]]></MediaId>
                            </Image>
                            </xml>";
            if($postObj->Event=="CLICK"){
                //获取城市名字
               /* $ip = $_SERVER['SERVER_ADDR'];
                $url = "http://api.jisuapi.com/ip/location?appkey=49f049d351201fa6&ip=$ip";
                $ch = curl_init();   //1.初始化
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
                $tmpInfo = curl_exec($ch);//6.执行
                $arr = json_decode($tmpInfo,true);
                $city = $arr['result']['city'];
                //获取天气情况
                $url2 = "http://api.jisuapi.com/weather/query?appkey=49f049d351201fa6&city=$city";
                $ch = curl_init();   //1.初始化
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url2); //2.请求地址
                $tmpInfo = curl_exec($ch);//6.执行
                $arr2 = json_decode($tmpInfo,true);
                $weather = $arr2['result']['weather'];
                $city = $arr2['result']['city'];
                $updatetime = $arr2['result']['updatetime'];
                $weather_str = "所在城市：".$city ."\n"."天气状况：".$weather ."\n"."更新时间：".$updatetime;
                $msgType = "text";
                $contentStr = $weather_str;
                echo sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                die;*/
                $media_id = $_SESSION['medisID'];
                if($media_id=='') {
                    $Accesstoken = $this->getAccesstoken();
                    $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $Accesstoken . "&type=image";
                    $data = array(
                        "file" => "@./web/upload/28335_205.jpg"
                    );
                    $json = $this->curlPost($url, $data, "POST");
                    $arr = json_decode($json, true);
                    $media_id = $arr['media_id'];
                    $_SESSION['medisID'] = $media_id;
                }
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
                $msgType = "image";
                $contentStr = $media_id;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                $keyword = trim($postObj->Content);
                if ($keyword != "") {
                    //回复图文消息
                    $sql = "select * from we_graphic_reply";
                    $pdo->exec("set names ut8");
                    $tu_data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($tu_data as $v) {
                        if ($keyword == $v['rekeyword']) {
                            $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <ArticleCount>1</ArticleCount>
                                <Articles>
                                <item>
                                <Title><![CDATA[".$v['retitle']."]]></Title>
                                <Description><![CDATA[".$v['grdesc']."]]></Description>
                                <PicUrl><![CDATA[http://123.56.88.15/shen/sixGroup/web/".$v['grurl']."]]></PicUrl>
                                <Url><![CDATA[".'http://www.baidu.com'."]]></Url>
                                </item>
                                </Articles>
                                </xml> ";
                            $resultStr = sprintf($template,$postObj->FromUserName, $postObj->ToUserName,time(),'news');
                            if(!empty($resultStr)){
                                echo $resultStr;
                            }
                        }
                    }
                    //关键字回复
                    $sql = "select * from we_reply where retype=1 AND aid=" . AID;
                    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $k => $v) {
                        $data[$k]['keyword'] = explode('，', $v['rekeyword']);
                        $data[$k]['reid'] = $v['reid'];
                    }
                    foreach ($data as $v) {
                        if (in_array($keyword, $v['keyword'])) {
                            $sql1 = "select * from we_text_reply where reid=" . $v['reid'];
                            $result1 = $pdo->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
                            $msgType = "text";
                            $rand = rand(0, count($result1) - 1);
                            $contentStr = $result1[$rand]['trcontent'];
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        }
                        if (!empty($resultStr)) {
                            echo $resultStr;
                        }
                    }
                }else{
                    $msgType = "text";
                    $contentStr = "欢迎关注，期待我的好作品";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
          }
        }else {
            echo "";
            exit;
        }
    }
    private function getAccesstoken(){
        //return "aaa";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
        $file=file_get_contents($url);
        $arr=json_decode($file,true);
        $Accesstoken=$arr['access_token'];
        return $Accesstoken;
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
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        return true;
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>