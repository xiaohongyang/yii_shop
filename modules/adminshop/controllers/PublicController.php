<?php

namespace app\modules\adminshop\controllers;
use app\modules\adminshop\models\Admin_user;
use yii\captcha\CaptchaAction;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 14:52
 */

class PublicController extends  BaseController{

    public function init()
    {

        $this->checkLogin = false;
    }

    public function actions()
    {
        return  [
            'captcha' => [
                'class' => CaptchaAction::className(),
                'minLength' => 7,
                'maxLength' => 7
            ]
        ];

    }

    public function actionLogin()
    {


        if (!\Yii::$app->shop_admin_user->isGuest) {

            $this->redirect(['/adminshop/index/index']);
        }

        $this->layout = 'login';

        $model = new Admin_user();

        $res = [
            'model' => $model
        ];

        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();

            $model->scenario = $model::SCENARIO_LOGIN;
            if ($model->load($post) && $model->validate($post) && $model->login($post)) {
                $this->redirect(Url::toRoute('index/index'));
            }
        }

        return $this->render('login', $res);

    }

    public function actionLogout()
    {

        if (\Yii::$app->shop_admin_user->isGuest) {

            jump_error("您尚示登录，退出失败!", '/');
        } else {

            $model = new Admin_user();
            if ($model->logout()) {

                jump_success("退出成功!", '/');
            }
        }
    }

}