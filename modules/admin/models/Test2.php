<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/16
 * Time: 15:36
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class Test2 extends ActiveRecord{


    public $name;
    public $password;


    public function rules()
    {
        return [

            [['name', 'password'], 'safe'],
            [['name', 'password'], 'required'],

        ];

    }

}