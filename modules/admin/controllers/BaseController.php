<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/5
 * Time: 17:41
 */

namespace app\modules\admin\controllers;


use yii\web\Controller;

class BaseController extends Controller{

    public $layout = 'main';

    public function init()
    {

        if (\Yii::$app->user->isGuest) {

            \Yii::$app->getResponse()->redirect(['admin/public/login']);

        }
    }



}