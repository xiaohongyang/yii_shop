<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/18
 * Time: 23:53
 */

namespace app\controllers;



use app\models\ContactForm;
use yii\web\Controller;

class Test2Controller extends Controller{


    public function actionTest()
    {
        echo 'test.html';

    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['captcha2','index'],
                        'allow' => true,
                    ],
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha2' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? null : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            \Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }


    public function actionCaptcha2()
    {
        return false;
    }

}