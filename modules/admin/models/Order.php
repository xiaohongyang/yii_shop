<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/9
 * Time: 18:21
 */

namespace app\modules\admin\models;


use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Order extends BaseModel{

    //登陆客户的id
    private $_customer_id = null;

    /**
     * 初始化
     * 1. 设置customer_id
     */
    public function init()
    {
        $this->_customer_id = 2;
    }

    /**
     * 设置customer relation
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer(){

        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);

    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    }

    /**
     * 设置 goods relation
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['goods_id' => 'goods_id'])
                    ->via('orderItems');
    }

    /**
     * 定义规则
     * @return array
     */
    public function rules()
    {
        /*
        order_id, customer_id, add_time, subtotal
        */
        return [
            [['customer_id', 'order_no'], 'required']
        ];
    }


    public function behaviors()
    {
        return [
          [
              'class' => TimestampBehavior::className(),

          ]
        ];
    }


    /**
     * 下单前数据处理
     * @param array $goodsAndNumber
     * @return bool
     */
    private function _beforePlaceOrder(array $goodsAndNumber)
    {
        if (is_array($goodsAndNumber) && count($goodsAndNumber)) {
            return true;
        } else{
            return false;
        }
    }

    /**
     * 下单
     * @param array $goodsAndNumber  商品id和商品数量组合数组 ex: [2=>1,3=>2] id为2的商品数量为1,id为3的商品数量为2
     * @return bool
     */
    public function placeOrder(array $goodsAndNumber)
    {

        if (!$this->_beforePlaceOrder($goodsAndNumber))
            return false;

        $transaction = Order::getDb()->beginTransaction();
        try {

            $order = new Order;
            $order->customer_id = $this->_customer_id;
            $order->order_no = $this->getOrder_no();

            if ($order->save() && $this->_afterPlaceOrder($order->order_id, $goodsAndNumber)) {

                //统计订单金额
                $subtotal = OrderItem::find()
                                        ->where( 'order_id = :order_id ', [':order_id'=>$order->order_id] )
                                        ->sum('subtotal');
                //更新订单金额
                $orderUp = Order::findOne(['order_id'=>$order->order_id]);
                $orderUp->subtotal = $subtotal;
                $orderUp->save();

                $transaction->commit();
                return true;
            } else {
                $this->addErrors($order->errors);
                return false;
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * 下单后数据处理
     * @param $order_id
     * @param array $goodsAndNumber
     * @return bool
     */
    private function _afterPlaceOrder($order_id, array $goodsAndNumber)
    {

        $result = true;
        $orderGoods = new OrderItem();
        foreach ($goodsAndNumber as $goods_id => $goods_number) {

            if( !$orderGoods->addOne($goods_id, $goods_number, $order_id) ){
                $result = false;
                break;
            }
        }
        return $result;
    }


    /**
     * 生成并返回一个唯一的order_no
     * @return string
     */
    private function getOrder_no(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}