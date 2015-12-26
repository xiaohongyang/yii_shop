<?php

namespace app\controllers;

use app\models\Country;
use app\models\EntryForm;
use Yii;
use yii\base\Behavior;
use yii\base\Component;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\View;

class SiteController extends Controller
{


    public function init(){


        //$this->layout = "@app/views/layouts/layout_01.php";

    }


    public function actionTest()
    {
        $arr = \Yii::$app->params['params'];


        echo \Yii::$app->params['adminEmail'];

        echo '<hr/>';

        echo $this->getViewPath();

        echo '<hr/>';

        print_r(\Yii::$app->request->get());

        echo $this->id;
        var_dump($this->actionParams);

        return $this->render('about');
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            //验证通过
            return $this->render('entry-confirm',['model'=>$model]);
        } else {
            return $this->render('entry',['model' => $model] );
        }

    }

    public function actionSay($message = "Hello")
    {
        echo 33;exit;
//       return $this->render("say",['message'=>$message]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }



    public function actionIndex()
    {


 return       $this->render('index');

//        $this->on('PersonEvents',function($event){
//           echo '334455';
//        });
//
//        $e = new PersonEvents();
//        $e->title = "中国人vv";
//
//        $this->on('PersonEvents',[$e, 'sayHello2']);
//        $this->on('PersonEvents',['app\controllers\PersonEvents', 'sayHello'],'Hello World!');
//      //  $this->on('PersonEvents','sayHello');
//
//        $this->off('PersonEvents', [$e, 'sayHello2']);
//        $this->off('PersonEvents', ['app\controllers\PersonEvents', 'sayHello'],'Hello World!');
//
//
//
//        $this->trigger('PersonEvents');


//        $rs  ;
//        print_r($rs);



//        $country = Country::findOne('CN');
//
//
//        echo '<hr/>';
//        $b = $country->behaviors['myBehavior4'];
//
//        echo $b->name;



//        echo $this->say();
//
//        echo 'name'.$this->name;

//        return $this->render('index');
    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {


        \Yii::$app->view->on(View::EVENT_END_BODY, function () {
            echo '=>'.date('Y-m-d')."<=";
        });

        return $this->render('about');
    }
}


class MyBehavior extends Behavior
{
    public  $name= "jack";

    private $_age = 0;

    public function  say(){
        echo $this->name;
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function getAge()
    {
        return $this->_age;
    }

    // 重载events() 使得在事件触发时，调用行为中的一些方法
    public function events()
    {
        // 在EVENT_BEFORE_VALIDATE事件触发时，调用成员函数 beforeValidate
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeValidate',
            Controller::EVENT_AFTER_ACTION => 'afterAction',

        ];
    }

    // 注意beforeValidate 是行为的成员函数，而不是绑定的类的成员函数。
    // 还要注意，这个函数的签名，要满足事件handler的要求。
    public function beforeValidate($event)
    {
        echo '<BR/>beforValidate<br/>';
        // ...
    }

    public function afterAction($event)
    {
        echo '<BR/>afterAction<br/>';

    }
}


class PersonEvents extends Event{

    public $title = null;
    public $time = null;

    static public function sayHello($event)
    {

        echo '<hr/>'.($event->data?$event->data:'Hi');

    }

    public function sayHello2($event)
    {
        echo '<hr/>title:'. $this->title;
    }


}
