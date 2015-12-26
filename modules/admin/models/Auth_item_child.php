<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/21
 * Time: 21:46
 */

namespace app\modules\admin\models;


use yii\rbac\Role;

class Auth_item_child extends BaseModel{

    const SCENARIO_CREATE = 'event_create';

    public $parent;

    public $child;

    public $childType;

    public $auth = null;

    public function init()
    {
        $this->auth = \Yii::$app->authManager;
    }

    public function rules()
    {
        return [

            [['prent'], 'required', 'on' => self::SCENARIO_CREATE],
            ['child', 'required', 'on' => self::SCENARIO_CREATE, 'message'=> t_arr('app', ['child','node','can\'t','be','null'],'','!')],
            ['child',   function ($attribute) {

                            if ($this->find()->where(['parent'=>$this->parent, 'child'=>$this->child])->count() > 0) {
                                //子节点已经存在
                                $this->addError($attribute, t_arr('app',['child','node','allready','exists'],'','!'));
                            }
                        }, 'on' => self::SCENARIO_CREATE
            ]

        ];
    }


    public function scenarios()
    {
        return [
          self::SCENARIO_CREATE => ['parent', 'child']
        ];
    }


    public function getAuthItem()
    {
        return $this->hasOne(Auth_item::className(), ['name' => 'child']);
    }

    //获取指定角色的子节点
    public function getChildListByName($name)
    {
        $auth = \Yii::$app->authManager;

        $childList = $auth->getChildren($name);

        foreach ($childList as &$child) {
            //子节点的子节点列表
            $child->data = $auth->getChildren($child->name);
        }

        return $childList ;
    }


    //添加子节点
    public function addChild( $parms )
    {

        $this->setScenario(self::SCENARIO_CREATE);
        if ($this->load($parms) && $this->validate()) {

            $auth = \Yii::$app->authManager;

            $this->childType = $parms[self::formName()]['childType'];

            $parent = $auth->getRole($this->parent);

            if($this->childType == 1)
                $child = $auth->getRole($this->child);
            else
                $child = $auth->getPermission($this->child);

            if (!$child) {

                $this->addError('child', t_arr('app',['child','node','not','exists'],'','!'));
                return false;
            }

            return $auth->addChild($parent, $child);
        }

    }

    public function deleteChild($parentName, $childName )
    {


        $auth = \Yii::$app->authManager;

        $parent = $auth->getRole( $parentName );
        $child = $auth->getPermission( $childName )? : $auth->getRole( $childName );

        if ($parent && $child) {

            return $auth->removeChild($parent, $child);
        } else {
            $this->addError( 'error', '父节点或子节点不存在!' );
            return false;
        }

    }

}