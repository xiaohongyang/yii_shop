<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/10
 * Time: 12:30
 */

namespace app\modules\admin\models;


class OrderItem extends BaseModel{

    /*public $order_id = null;
    public $goods_id = null;
    public $item_name = null;
    public $item_price = null;
    public $item_unit = null;
    public $item_number = null;
    public $subtotal = null;*/

    public function rules()
    {
        // order_goods_id, order_id, goods_id, item_name, item_price, item_unit, item_number, subtotal


        return [
            [[ 'order_id', 'goods_id', 'item_name', 'item_price', 'item_unit', 'item_number', 'subtotal' ],'required']
        ];
    }


    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['goods_id' => 'goods_id']);
    }


    /**
     * 添加一个商品到订单商品明细表中
     * @param $goods   商品ActiveRecord 或 商品id
     * @param $number  商品数量
     * @param $orderid 订单id
     * @return OrderItem|bool
     */
    public function addOne($goods=0, $number=1, $orderid=null)
    {

        $orderItem = new OrderItem();

        if (is_integer($goods)) {
            $goods = Goods::findOne(['goods_id' => $goods]);
        }


        $orderItem->item_name = $goods['goods_name'];
        $orderItem->item_price = $goods['goods_price'];
        $orderItem->item_unit = $goods['goods_unit'];
        $orderItem->goods_id = $goods['goods_id'];


        $orderItem->item_number = $number;
        $orderItem->subtotal = $goods['goods_price'] * $number;
        $orderItem->order_id = $orderid;



        return $orderItem->save()? $orderItem : false;
    }

}