<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/5/28
 * Time: 13:25
 */

namespace app\controllers;


use app\models\TestModel;
use linslin\yii2\curl\Curl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\Controller;

class TestsayController extends Controller{

    public $url = 'http://yii.com/users';

    public function actionExample()
    {



        /*$this->url = 'http://yii.com/user/myview/63';
        $curl = new Curl();

        $reponse = $curl->get($this->url);

        p($curl->responseCode);


        p($reponse);*/


        //Init curl
        $curl = new  Curl();

        //get http://example.com/
        //$response = $curl->get('http://yii.com/users');

        //Init curl
        $curl = new Curl();

        //post http://example.com/
        $rs = $curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query(array(
                    'ac_info' => 'test_create',
                    'ac_title' => 'test_create'
                )
            ))
            ->post('http://yii.com/user/create');

        p($rs);


        //删除一行数据
        //$rs = $curl->delete('http://yii.com/users/14415');


    }

    public function actionSay()
    {

        $url = 'http://yii.com/users' ;


        $curl = new Curl();

        $rs = $curl->get($url);


        p($rs);

        p($curl);

exit;

//        exit;
//        $curl->head( 'http://yii.com/users' );


        /*$curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query(array(

                )
            ));
        $rs = $curl->post($url);

        p($rs);


        $options = $curl->setOption(CURLOPT_POSTFIELDS, 'category_name')->get($url);


        p($options);*/
    }




    public function actionView($id)
    {

        return TestModel::findOne(63)->toArray();
    }
}