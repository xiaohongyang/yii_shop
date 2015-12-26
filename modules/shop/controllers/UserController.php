<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 11:09
 */

namespace app\modules\shop\controllers;


class UserController extends BaseController{

    public function actionIndex()
    {


        $info = "您好,%s,欢迎登录用户中心!";
        printf($info, \Yii::$app->shop_user->getIdentity()->user_name) ;
    }

}