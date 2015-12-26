<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/4
 * Time: 21:21
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Adminuser;
use app\modules\admin\models\CustomerModel;
use app\modules\admin\models\Goods2;
use app\modules\admin\models\User;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;
use yii\web\Controller;

class PublicController extends Controller{


    public function actions()
    {
        return [

            'captcha' => [
                'class' => CaptchaAction::className(),
                'minLength' => 7,
                'maxLength' => 7
            ]
        ];
    }


    public function actionIndex()
    {

        $this->redirect(['public/login']);

    }

    public function test($event)
    {
        echo '<hr/>';
        echo $this->className();
        echo '<hr/>';

        p($event->data);
    }

    //登陆页面/处理登陆信息
    public function actionLogin(){


        $this->layout = "login";

        if(!\Yii::$app->user->isGuest)
            $this->redirect(['index/index']);

        $user = new User();

        if (\Yii::$app->request->isPost) {
            if ($user->login(\Yii::$app->request->post())) {
                $this->redirect(['index/index']);
            }
        }

        return $this->render('login', ['model' => $user]);

    }


    //用户登出
    public function actionLogout()
    {

        $user = new User();
        $user->logout();

        $this->goHome();
    }



}