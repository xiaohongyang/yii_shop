<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/1
 * Time: 18:05
 */

namespace app\controllers;


use app\models\Guest_book;
use app\models\GuestBook;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\widgets\LinkPager;

class GuestbookController extends Controller{

    public function actionIndex()
    {

        $model = new GuestBook();

        $page = $model->getListRow(array());



       return $this->render('index',[
           'model' => $model,
           'page' => $page,
       ]);

    }

}