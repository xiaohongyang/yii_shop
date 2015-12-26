<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 13:41
 */

namespace app\modules\adminshop\controllers;


class IndexController extends BaseController{



    public function actionIndex()
    {

        $this->layout = 'frame';
        return $this->render('index');
    }

    public function actionMain()
    {
        $this->render('main');
    }
}