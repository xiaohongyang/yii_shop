<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/17
 * Time: 11:41
 */

namespace app\modules\admin\models;


use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;

class Auth_item extends BaseModel{

    //场景
    const SCENARIO_ROLE_CREATE = 'role_create';
    const SCENARIO_ROLE_UPDATE = 'role_update';

    const SCENARIO_PERMISSION_CREATE = 'permission_create';
    const SCENARIO_PERMISSION_UPDATE = 'permission_update';

    public $listChild = null;

    public $auth;

    public function init()
    {
        $this->auth = \Yii::$app->authManager;
    }
    /*
     name
    type
    description
    rule_name
    data
    created_at
    updated_at

     */

    /*public $name;
    public $type;
    public $description;
    public $rule_name;
    public $data;
    public $created_at;
    public $updated_at;*/

    private $_test;

    public function getTest()
    {
        return $this->name. $this->created_at;
    }


    /**
     * 场景
     *
     * @return array
     */
    public function scenarios()
    {
        return [
            'default' => ['created_at'],
            static::SCENARIO_ROLE_CREATE => ['name', 'description'],
            static::SCENARIO_ROLE_UPDATE => ['name', 'description'],
            static::SCENARIO_PERMISSION_CREATE => ['name', 'description'],
            static::SCENARIO_PERMISSION_UPDATE => ['name', 'description'],
        ];
    }

    /**
     * 规则
     *
     * @return array
     */
    public function rules()
    {
        return [

            array('name', 'safe'),

            [['name','description'], 'required', 'on'=>'role_create'],
            ['name', 'isNameExists', 'on' => 'role_create'],

            [['name','description'], 'required', 'on'=>static::SCENARIO_PERMISSION_CREATE],
            ['name', 'isNameExists', 'on' => static::SCENARIO_PERMISSION_CREATE],


            [['name','description'], 'required', 'on'=>static::SCENARIO_PERMISSION_UPDATE],
            ['name', 'isNameExists', 'on' => static::SCENARIO_PERMISSION_UPDATE],
        ];
    }


    public function getAuthItemChilds()
    {
        return $this->hasMany(Auth_item_child::className(), ['parent' => 'name']);
    }

    public function getChilds()
    {
        return $this->hasOne(Auth_item::className(), ['name' => 'child'])
                    ->via('authItemChilds');
    }


    /**
     * 创建角色
     *
     * @param $params
     * @return bool
     */
    public function roleCreate($params)
    {

        $auth = \Yii::$app->authManager;

        $this->scenario = static::SCENARIO_ROLE_CREATE;

        if ($this->load($params) && $this->validate()) {

            $role = $auth->createRole($this->name);
            $role->description = $this->description;

            return $auth->add($role);
        }
    }

    /**
     * 检测name是否已经存在
     *
     * @param $attribute
     * @param $params
     */
    public function isNameExists($attribute, $params)
    {

        if ($this->isNewRecord) {

            if ($this->findOne(['name' => $this->name])) {
                $this->addError($attribute, $this->getAttributeLabel($attribute).\Yii::t('app','Already exist'));
            }
        } else {
            if ($this->findOne(['name' => $this->name]) && $this->name != $this->getAttribute('name')) {
                $this->addError($attribute, $this->getAttributeLabel($attribute).\Yii::t('app','Already exist'));
            }
        }
    }


    /**
     * 角色/模块列表
     * 1.角色没有子节点没有父节点, 模块有子节点也有父节点
     *
     * @return ActiveDataProvider
     */
    public function roleList($hasChild=null)
    {
        $query = Auth_item::find();
        $query->andFilterWhere([ '=' ,'type' , '1']);

        if (!is_null($hasChild)) {

            if ($hasChild == 1) {
                //角色

                $query->andFilterWhere(['not in', 'name' , Auth_item_child::find()->select('child')]);
            } else if($hasChild == 0) {
                //模块

                $query->andFilterWhere(['in', 'name' , Auth_item_child::find()->select('parent')]);
                $query->andFilterWhere(['in', 'name' , Auth_item_child::find()->select('child')]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' =>  8
            ]
        ]);


        return $dataProvider;

    }

    /**
     * 角色更新
     *
     * @param $params
     * @return bool
     */
    public function roleUpdate($params)
    {

        $this->setIsNewRecord(false);

        $this->scenario = static::SCENARIO_ROLE_UPDATE;
        if ($this->load($params) && $this->validate()) {

            $auth = \Yii::$app->authManager;

            $role = $auth->createRole($this->name);
            $role->description = $this->description;

            return $auth->update($this->getAttribute('name'), $role);
        }

        return false;
    }

    public function roleDelete($params)
    {
        $auth = \Yii::$app->authManager;
        if (!empty($params['name'])) {

            $role = $auth->getRole($params['name']);
            if($role)
                return $auth->remove($role);
        }

        return false;
    }


    /**
     * 创建许可
     *
     * @param $params
     * @return bool
     */
    public function permissionCreate($params)
    {
        $auth = \Yii::$app->authManager;

        $this->scenario = static::SCENARIO_PERMISSION_CREATE;

        if ($this->load($params) && $this->validate()) {

            $permission = $auth->createPermission($this->name);
            $permission->description = $this->description;

            return $auth->add($permission);
        }
    }

    /**
     * 许可列表
     *
     * @return ActiveDataProvider
     */
    public function permissionList($params = [])
    {

        $name =null;
        $query = Auth_item::find();

        if (is_array($params) && count($params)) {

            $params['name'] && $name = $params['name'];
        }

        $query->andFilterWhere(['=', 'type', '2']);

        !is_null($name) && $query->andFilterWhere(['like','name',$name]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>  [
                'pageSize' => 10
            ]
        ]);

        return $dataProvider;
    }


    /**
     * 许可更新
     *
     * @param $params
     * @return bool
     */
    public function permissionUpdate($params)
    {

        $this->setIsNewRecord(false);

        $this->scenario = static::SCENARIO_PERMISSION_UPDATE;
        if ($this->load($params) && $this->validate()) {

            $auth = \Yii::$app->authManager;

            $permissionUpdate = $auth->createPermission($this->name);
            $permissionUpdate->description = $this->description;
            return $auth->update($this->getAttribute('name'), $permissionUpdate);
        }

        return false;
    }


    /**
     * 许可删除
     *
     * @param $params
     * @return bool
     */
    public function permissionDelete($params)
    {
        $auth = \Yii::$app->authManager;
        if (!empty($params['name'])) {

            $name = $params['name'];
            $permission = $auth->getPermission($name);
            if($permission)
                return $auth->remove($permission);
        }

        return false;
    }


}