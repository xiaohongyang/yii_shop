<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/1/12
 * Time: 22:18
 */

namespace app\modules\adminshop\controllers;


use app\modules\adminshop\models\User_rank;
use yii\web\User;

class UsersController extends BaseController{



    public function actionList(){


        $rankList = User_rank::find()->orderBy('min_points asc')->all();

        $userList = array();
        $userList['rankList'] = $rankList;
        return $this->render('list', ['userList'=> $userList]);

    }

}