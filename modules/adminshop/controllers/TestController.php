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

        $m = Test_student::find(['id'=>20])->all();
        echo $m->name;
        echo $m['name'];

        p($m);
        exit;

        $m->name = 321;
        $m->save();

        $m = Test_student::find(['id'=>20])->all();
        echo $m->name;
        echo $m['name'];


    }




    public  function  actionCreate(){

        $model = new Test_student();
        $post = \Yii::$app->request->post();

        $param = array('info'=>'');

        //$model->created_on = time();
        if(\Yii::$app->request->isPost){
            if($model->load($post) && $model->validate() && $model->save())
                $param['info'] = '添加成功!';
        }

        return $this->render('create', ['model'=>$model, 'param'=>$param] );
    }

}