<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/9
 * Time: 21:11
 */

namespace app\modules\admin\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Goods extends BaseModel{

    const SCENARIO_CREATE = 'scenario_create';
    const SCENARIO_UPDATE = 'scenario_update';
    const SCENARIO_DELETE = 'scenario_delete';

    public function behaviors()
    {
        return  [
                    [
                        'class' => TimestampBehavior::className(),
                    ]
                ];
    }




    //定义规则
    public function rules()
    {
        return [
            [
                ['goods_name', 'goods_price', 'goods_unit', 'owner_id' ], 'required', 'on' => self::SCENARIO_CREATE
            ],

            [
                ['goods_name', 'goods_price', 'goods_unit', 'owner_id' ], 'required', 'on' => self::SCENARIO_UPDATE
            ],

            [
                ['goods_id'], 'required', 'on' => self::SCENARIO_DELETE
            ],


        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['goods_name', 'goods_price', 'goods_unit', 'owner_id'],
            self::SCENARIO_UPDATE => ['goods_name', 'goods_price', 'goods_unit', 'owner_id']
        ];
    }

    public function create($params=[])
    {

        $this->scenario = self::SCENARIO_CREATE;
        if ($this->load($params) && $this->validate()) {

            return $this->save();
        }
    }


    public function edit( $item )
    {

        return $item->save();

    }


}