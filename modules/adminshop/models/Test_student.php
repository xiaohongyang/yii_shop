<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/12/24
 * Time: 22:27
 */

namespace app\modules\adminshop\models;


use yii\db\ActiveRecord;

class Test_student extends ActiveRecord  {
    public function rules()
    {

        return [
            ['name', 'required'],
            [['name','email'], "required"],
            ['email','email']
        ];
    }


}