<?php

namespace app\controllers;

use app\models\Country;
use app\models\EntryForm;
use app\models\Users;
use Yii;
use yii\base\Behavior;
use yii\base\Component;
use yii\base\Event;
use yii\behaviors\InitcontrollerBehavior;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\View;

class PublicController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['Initcontroller'] = [
            'class' => InitcontrollerBehavior::className()
        ];

        return $behaviors;

    }


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

    public function actionRegister()
    {

        $model = new Users();

        $result = [
            'model' => $model
        ];

        if (\Yii::$app->request->isPost) {

            $post = \Yii::$app->request->post();
            if ($model->load($post) && $model->validate()) {
                echo '注册成功';
            }

        }


        return $this->render('register', $result);
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
