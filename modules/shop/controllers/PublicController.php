<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 17:12
 */
namespace app\modules\shop\controllers;
use app\modules\shop\models\Users;
use yii\captcha\CaptchaAction;
use yii\web\Controller;
use yii\web\UrlManager;

class PublicController extends BaseController{


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


        if (\Yii::$app->shop_user->getId()) {

            $this->redirect('/shop/user/index');
            /*$this->redirect(['/shop/user/index']);
            exit;*/
        }

        $this->layout = 'login';
        $model = new Users();
        $viewBag = [
            'model' => $model
        ];

        //处理登录表单提交
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();

            $model->scenario = $model::SCENARIO_LOGIN;
            if ($model->load($post) && $model->validate($post) && $model->login($post)) {

                $this->redirect('/shop/user/index');
            }
        }

        return $this->render('login', $viewBag);

    }

    public function actionLogout()
    {

        if (\Yii::$app->shop_user->isGuest) {
            jump_error('您没未登录, 无法退出!', '/');
        }

        $model = new Users();

        if ($model->logout()) {
            jump_success('退出登录成功!');
        }

    }

    public function actionRegister()
    {

        $model = new Users();

        $result = [
            'model' => $model
        ];

        if (\Yii::$app->request->isPost) {

            $post = \Yii::$app->request->post();

            $model->scenario = $model::SCENARIO_CREATE;
            if ($model->load($post) && $model->validate()) {
                echo '注册成功';
            }

        }


        return $this->render('register', $result);
    }

}