<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/1/12
 * Time: 22:16
 */

namespace app\modules\adminshop\models;


use yii\db\ActiveRecord;

class User_rank extends ActiveRecord{



    public $rank_id;        //会员等级编号，其中0是非会员
    public $rank_name;      //会员等级名称
    public $min_points;     //该等级的最低积分
    public $max_points;     //该等级的最高积分
    public $discount;       //该会员等级的商品折扣
    public $show_price;     //是否在不是该等级会员购买页面显示该会员等级的折扣价格.1,显示;0,不显示
    public $special_rank;   //是否事特殊会员等级组.0,不是;1,是



    public function rules()
    {
        return [
            ['rank_name', 'safe']
        ];
    }

    public function fields()
    {
        return [
            'rank_id',
            'rank_name',
            'min_points'
        ];
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {

        $arr = parent::toArray($fields, $expand, $recursive);

        if(is_array($arr) && count($arr)){

            foreach($arr as $k=>$v){
                $arr[$k] = $this->getAttribute($k);
            }
        }
        return $arr;
    }


}