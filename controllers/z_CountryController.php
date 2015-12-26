<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/5/28
 * Time: 14:40
 */

namespace app\controllers;


use app\models\Country;
use yii\data\Pagination;
use yii\web\Controller;

class CountryController extends Controller{

    public function actionIndex()
    {
        $query = Country::find();

        $limit = 3;
        $count = $query->count();

        //分页信息
        $pagination = new Pagination(['defaultPageSize'=>3,'totalCount'=>$count]);

        $countries = $query->orderBy('name')
                            ->offset($pagination->offset)
                            ->limit($pagination->limit)
                            ->all();


        return $this->render('index',['countries' => $countries,
                                        'pagination' => $pagination ]);



    }

}