<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/9
 * Time: 18:19
 */

namespace app\modules\admin\models;


class Customer extends BaseModel{


    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id'])->inverseOf('customer');
    }


    public function getBigOrders($threshould = 100)
    {
        return  $this   ->hasMany(Order::className(), ['customer_id' => 'id'])
                        ->where(' subtotal > :threshould ', [':threshould' => $threshould])
                        ->orderby('customer_id');
    }

}