<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Reply;
use app\models\TextReply;
use app\models\Account;
use yii\data\Pagination;

class ReplyController extends Controller
{
    /*
     *  加载文字回复的页面
     */
    public function actionWord()
    {
        $account_data = Account::find() -> select('aname,aid') -> asArray() ->all();
        return $this -> renderPartial('word',['account_data'=>$account_data]);
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
        }
    }

	/*
	    文字回复规则管理
	*/
	public function actionReply()
	{
		return $this -> renderPartial('show');
	}
}