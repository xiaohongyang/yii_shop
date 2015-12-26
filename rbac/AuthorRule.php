<?php
namespace app\rbac;
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/12
 * Time: 14:41
 */


class AuthorRule extends \yii\rbac\Rule{

    public $name = 'authorRule';

    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        //管理员
        if($group = \Yii::$app->user->identity->group == 1)
            return true;

        //非管理员
        return isset($params['post']) ? $params['post']->createBy == $user : false;
    }
}