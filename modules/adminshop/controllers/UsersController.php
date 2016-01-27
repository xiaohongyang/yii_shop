<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/1/12
 * Time: 22:18
 */

namespace app\modules\adminshop\controllers;


use app\modules\adminshop\models\User_rank;
use app\modules\adminshop\models\Users;
use app\modules\adminshop\models\UsersSearch;
use yii\data\ActiveDataProvider;
use yii\web\User;

class UsersController extends BaseController{



    public function actionList(){


        $rankList = User_rank::find()->orderBy('min_points asc')->all();

        $userList = array();
        $userList['rankList'] = $rankList;


        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('list', [
                                    'model'=> $searchModel,
                                    'dataProvider'=>$dataProvider,
                                    'rankList' => $rankList
                                ]
                            );

    }

    public function actionEdit(){
        echo 33;
    }

}