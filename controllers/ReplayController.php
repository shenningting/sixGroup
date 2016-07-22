<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Account;
use app\models\Graphic;
use yii\data\Pagination;
use yii\web\UploadedFile;

class ReplayController extends Controller
{
    /*
     *  加载添加页面
     */
    public function actionIndex()
    {
        $aid = yii::$app->request->get('aid');
        $session = \YII::$app->session;
        $session->open();
        $rename = $session->get('uname');
        $data['re'] = $rename;
        $data['aid'] = $aid;
        //print_r($data);die;
        return $this->renderPartial('add_img',$data);
    }

    /*
     * 添加数据
     */
    public function actionAdd_img(){

        if(yii::$app->request->isPost){
            $file = UploadedFile::getInstanceByName('grurl');
            $name = $file->name;                //获取图片的名称
            $dir='upload/';//上传目录
            //判断是否有文件    没有则创建
            if(!file_exists($dir)){
                mkdir($dir,777,true);
            }
            $t_name = $dir.$name; //文件名绝对路径
            $start = $file->saveAs($t_name,true);    //调用模型类中的方法  把文件上传
            if($start){
                $connection = \Yii::$app->db;
                $data = \Yii::$app->request->post();
                $data['grurl'] = $t_name;
                unset($data['_csrf']);
                $res = $connection->createCommand()->insert('we_graphic_reply',$data)->execute();
                if($res>0){
                    echo "<script>alert('添加成功');location='index.php?r=replay/index'</script>";
                }else{
                    echo "<script>alert('添加失败');location='index.php?r=replay/index'</script>";
                }
            }else{
                echo "<script>alert('彻底失败');location='index.php?r=replay/index'</script>";
            }
        }else{
            return $this->renderPartial('add_img');
        }
    }
}