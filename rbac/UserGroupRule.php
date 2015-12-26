<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/12
 * Time: 15:11
 */

namespace app\rbac;


use yii\rbac\Item;
use yii\rbac\Rule;

class UserGroupRule extends Rule{

    public $name = 'userGroup';

    /**
     * check if group matches
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[ManagerInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        // TODO: Implement execute() method.
        if (!\Yii::$app->user->isGuest) {


            $group = \Yii::$app->user->identity->group;
            if ($item->name == 'admin') {
                return $group==1;
            } else {
                return $group==1 || $group==2;
            }
        }
        return false;
    }
}