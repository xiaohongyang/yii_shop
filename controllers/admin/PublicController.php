<?php

namespace app\controllers\admin;

use app\models\EntryForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class PublicController extends Controller{



    public function actionLogin()
    {
        echo $this->getViewPath();

        exit;
    }

}