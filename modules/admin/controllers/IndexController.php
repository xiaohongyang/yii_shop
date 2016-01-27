<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/4
 * Time: 14:36
 */

//namespace app\modules\admin\controlles;
namespace app\modules\admin\controllers;


use yii\base\Event;
use yii\web\Controller;
use yii\web\View;

class IndexController extends BaseController{


    public function init()
    {
        parent::init();
    }


    public function actionIndex()
    {

        $this->layout = 'frame';

        \Yii::$app->view->on(View::EVENT_BEGIN_BODY, function () {

        });

        return $this->render('index');

    }

    public function actionHead()
    {

        return $this->render('head');
    }
}