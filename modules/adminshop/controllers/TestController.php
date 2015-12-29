<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/12/23
 * Time: 22:27
 */

namespace app\modules\adminshop\controllers;


use app\models\Shop_config;
use app\modules\adminshop\models\Test_student;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class TestController extends BaseController{


    public  function  actionTest(){

//        $shopConfig = new Shop_config();
//
//        $result = $shopConfig->find()->where('id > :id', array(':id' => 900))->all();
//
//        foreach($result as $v){
//
//            echo ($v->id. ':' . $v->code . "\r\n");
//        }

        echo \Yii::getAlias("@webroot")."<hr/>";



        $model = new Test_student();
        $result = $model->find()->where('id > :id', array(':id' => 0))->all();
        foreach($result as $row){
            print_r($row);

            echo $row->id;
            echo $row->name;
        }

    }


    public  function  actionCreate(){

        $model = new Test_student();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            \Yii::$app->session->setFlash('success', '添加成功!');
        }

        return $this->render("create", ["model" => $model ]);

    }

}