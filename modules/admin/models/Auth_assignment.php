<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/19
 * Time: 13:54
 */

namespace app\modules\admin\models;


class Auth_assignment extends BaseModel{

    public $user_id;
    public $item_name;

    const EVENT_ASSIGN_CREATE = 'event_assign_create';
    const EVENT_ASSIGN_UPDATE = 'event_assign_update';
    const EVENT_ASSIGN_DELETE = 'event_assign_delete';


    function rules()
    {
        return [

            ['user_id', 'number'],
            [['user_id' ], 'required', 'on' => self::EVENT_ASSIGN_CREATE],

            [['user_id'], 'required', 'on' => self::EVENT_ASSIGN_UPDATE],
            [['user_id'], 'required', 'on' => self::EVENT_ASSIGN_DELETE],
        ];
    }

    function  scenarios()
    {
        return [
            self::EVENT_ASSIGN_CREATE => ['user_id', 'item_name'],
            self::EVENT_ASSIGN_UPDATE => ['user_id', 'item_name'],
            self::EVENT_ASSIGN_DELETE => ['user_id'],
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id'=>'id']);
    }


    public function getAllRoles()
    {
        $auth = \Yii::$app->authManager;
        return $auth->getRoles();

    }

    public function getAllRoles2SelectArray()
    {
        $rolesArr = [];
        $allRoles = $this->getAllRoles();
        if (is_array($allRoles) && count($allRoles)) {
            foreach ($allRoles as $_k=>$row) {
                $rolesArr[$row->name] = $row->description;
            }
        }

        return $rolesArr;
    }

    /**
     * 赋予用户角色
     *
     * @param $params
     * @return \yii\rbac\Assignment
     */
    public function assign_user_create($params)
    {

        $this->scenario = self::EVENT_ASSIGN_CREATE;

        if ($this->load($params) && $this->validate()) {

            Auth_assignment::deleteAll(['user_id' => $this->user_id]);

            $auth = \Yii::$app->authManager;

            if (is_array($this->item_name) && count($this->item_name)) {

                foreach ($this->item_name as $_k => $item_name) {


                    $role = $auth->getRole($item_name);
                    $auth->assign($role, $this->user_id);

                }

            }
            return true;
        }
        return false;

    }

    public function getAssignmentByUserid($user_id)
    {
        if (!is_numeric($user_id) || !$user_id) {
            $this->addError('error', '用户id错误!');
            return false;
        }

        $auth = \Yii::$app->authManager;
        return $auth->getAssignments($user_id);

    }

}