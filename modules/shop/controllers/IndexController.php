<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 11:38
 */

namespace app\modules\shop\controllers;


use yii\web\Controller;

class IndexController extends BaseController{

    public function actionIndex()
    {


        return $this->render('index', array());
    }

    public function actionTest()
    {
        return $this->render('test.html');
    }

}