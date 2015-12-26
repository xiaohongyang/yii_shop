<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/1
 * Time: 17:11
 */

namespace app\controllers;


use yii\web\Controller;

class ArticleController extends Controller{

    public function actionIndex()
    {



        return $this->render('index');
    }

}