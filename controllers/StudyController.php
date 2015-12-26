<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/23
 * Time: 13:45
 */

namespace app\controllers;


use app\modules\admin\models\Goods;
use app\modules\admin\models\Order;
use app\modules\admin\models\OrderItem;
use linslin\yii2\curl\Curl;
use yii\helpers\Url;
use yii\web\Controller;

class StudyController extends Controller{

    public function init()
    {
        header('content-type=text/html; charset=utf-8;');
    }

    public function actionIndex()
    {

        /*$curl = new Curl();

        $url = Url::toRoute('user/index','http');


        $content =$curl->get($url, 0);


        p($content);*/


        /*$goods = new Goods();

        $item = [
            'goods_name' => '香蕉',
            'goods_price' => '5.5',
            'goods_unit' => '1',
            'owner_id' => 1
        ];

        $rs = $goods->create([$goods->formName()=>$item]);

        p($rs);*/




/*
        $item = Goods::findOne(7);


        $item->goods_price = 9.8;

        $item->scenario = Goods::SCENARIO_UPDATE;
        $rs = $item->save();

        p($rs);
        p($item);*/

        /*$order = new Order();
        $rs = $order->placeOrder([7=>1, 10=>2, 11=>5]);
        p($rs);*/


        $order = Order::findOne(21);

        $items = $order->getGoods()->all();

//        p($items);

        $orderItem = $order->getOrderItems()->all();



        foreach ($orderItem as $item) {

            $goods = $item->getGoods()->one();

            echo ($item->item_name.'=>'. date ('Y-m-d H:i:s',$goods->created_at ). '价格:'.$goods->goods_price.' 数量:'.$item->item_number. '总额:'.$item->subtotal ).'<br/>';
        }



        /*$orderItem = new OrderItem();
        $rs = $orderItem->addOne(7,1,12);
        p($rs);

        p($orderItem->getErrors());*/
    }

}