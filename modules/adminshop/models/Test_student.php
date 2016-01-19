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

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_CREATE = 'create';

    public  $name;
    public  $created_on;


    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'checkName'],
            [['name','email'], "required"],
            ['email','email'],
            ['created_on', 'required'],
            ['created_on', 'checkCreatedOn', ]

        ];
    }

    public function scenarios()
    {

        $scenarios = [
            self::SCENARIO_DEFAULT => [
                'created_on',
                'name',
                'email'
            ]
        ];

        return array_merge(parent::scenarios(), $scenarios);
    }


    public function updateHandle($data){

        $modle = $this->findOne($data['id']);
        $modle->name = $data['name'];

        return $modle->save();

    }

    /**
     * @author: 肖红阳
     * check created_on column
     * @param $attribute
     */
    public function checkCreatedOn($attribute, $params){

        p($this->$attribute);
        if( empty($this->$attribute) || str_len($this->$attribute)<4 || is_null($this->$attribute) || ! $this->$attribute > 0){
            $this->addError($attribute, "created_on 错误!");
        } else{
            $this->setAttribute($attribute, $this->$attribute);
        }

    }

    public  function checkName($attribute, $params){
        if( !empty($this->$attribute) && strlen($this->$attribute) < 4 ){
            $this->addError($attribute, 'name 长度太短');
        }else{
            $this->setAttribute($attribute, $this->$attribute);
        }
    }



}