<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 11:15
 */

namespace app\controllers;


use app\models\Shop_config;
use app\models\Shop_configModel;
use yii\web\Controller;

class InitController extends Controller{

    public function actionInit()
    {
        $Shop_config = new Shop_config();

        $rs = $Shop_config->getList();

    }

}