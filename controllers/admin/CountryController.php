<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/1
 * Time: 17:06
 */

namespace app\controllers\admin;


use app\models\CountrySearch;
use yii\web\Controller;

class CountryController extends Controller{

    public function actionIndex()
    {
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

       echo 33;exit;
    }

}