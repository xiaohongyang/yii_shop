<?php
/**
 * rbac权限设置
 * User: xiaohongyang
 * Date: 2015/6/12
 * Time: 14:02
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Auth_assignment;
use app\modules\admin\models\Auth_item;
use app\modules\admin\models\Auth_item_child;
use app\modules\admin\models\User;
use app\rbac\AuthorRule;
use app\rbac\UserGroupRule;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\View;

class RbacController extends BaseController{

    public $auth;

    public function init()
    {

        $this->auth = \Yii::$app->authManager;
    }

    /**
     * 角色列表
     *
     * @return string
     */
    public function actionRole_list()
    {

        $model = new Auth_item();
        $dataProvider = $model->roleList(\Yii::$app->request->get('hasparent'));

        return $this->render('role_list', ['model' => $model, 'dataProvider' => $dataProvider]);
    }

    /**
     * 创建角色
     *
     * @return string
     */
    public function actionRole_create()
    {

        $model = new Auth_item();
        if (\Yii::$app->request->isPost) {

            $model->roleCreate(\Yii::$app->request->post());
        }

        return $this->render('role_create', ['model' => $model]);
    }


    public function actionRole_update()
    {
        $model = null;
        if (\Yii::$app->request->isGet) {

            $name = \Yii::$app->request->get('name');
            if (empty($name) || trim($name) == "")
                jump_error(\Yii::t('app', 'Information does not exists!'));
            else
                $model = Auth_item::findOne(['name'=>$name]);
        } else if(\Yii::$app->request->isPost){

            $model = new Auth_item();
            if ($model->roleUpdate(\Yii::$app->request->post())) {
                jump_success(t_arr('app',['update','success'],'','!'));
            }

        }

        return $this->render('role_update',['model'=>$model]);
    }

    public function actionRole_delete()
    {
        $model = new Auth_item();
        if ($model->roleDelete(\Yii::$app->request->get())) {
            jump_success(t_arr('app', ['delete','success'],'','!'));
        } else {
            jump_error(t_arr('app', ['delete','fail'],'','!'));
        }
    }

    public function actionInit()
    {

        /*
        //singup 给用户设置组
        $auth = \Yii::$app->authManager;
        $authRole = $auth->getRole('author');
        $auth->assign($authRole, 33);*/

        //add permission



       /* $createPost = $auth->createPermission('createPost');
        $createPost->description = 'createPost';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'updatePost';
        $auth->add($updatePost);*/

        //add role and give this role the pemission

       /* $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);


        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);*/


        /*$auth->assign($admin, 1);
        $auth->assign($author, 2);*/



        $auth = \Yii::$app->authManager;

//        $rule = new UserGroupRule();
//        $auth->add($rule);
//
//        $author = $auth->createRole('author');  //角色
//        $author->ruleName = $rule->name;
//        $auth->add($author);


        /*$rule = new AuthorRule();
        $auth->add($rule);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'updatePost';
        $auth->add($updatePost);

        //add permission
        $permission = $auth->createPermission('updateOwnPost');
        $permission->description = $rule->name;
        $permission->ruleName = $rule->name;
        $auth->add($permission);

        $auth->addChild($permission, $updatePost);*/



        $udpatePost = $auth->getPermission('updatePost');







        //删除许可


//        $author = $auth->createRole('author');
//        $author->description = 'author';
//        $auth->add($author);
//        $auth->addChild($author, $udpatePost);
//
//        $admin = $auth->createRole('admin');
//        $admin->description = 'admin';
//        $auth->add($admin);
//        $auth->addChild($admin, $udpatePost);




        p(\Yii::$app->user->can('admin'));
        p(\Yii::$app->user->can('author'));
        p(\Yii::$app->user->can('createPost'));
        p(\Yii::$app->user->can('updatePost'));


       // $auth->assign($updatePost, \Yii::$app->user->getId());

//        $auth->addChild($updatePost, $author);

        // $auth->removeChild($author, $updatePost);

        //2
      /*
      $rule = new \app\rbac\AuthorRule;
        $auth->add($rule);

        exit;*/


        /*$auth->removeAllRoles();
        $auth->removeAllPermissions();


        exit;

        $rule = new \app\rbac\UserGroupRule;

        $auth->add($rule);

        $author = $auth->createRole('author');
        $author->ruleName = $rule->name;
        $auth->add($author);

        //... add permissions as chiled of $author

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $author);*/

        // ..  add permissions as chiled of $admin



        /*$updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);


        $auth->addChild($updateOwnPost, $auth->getPermission('updatePost'));

        $auth->addChild($auth->getRole('author'), $updateOwnPost);*/

    }



    /**
     * 许可列表
     *
     * @return string
     */
    public function actionPermission_list()
    {

        $params = \Yii::$app->request->post();


        $model = new Auth_item();
        $dataProvider = $model->permissionList($params);


        return $this->render('permission_list', ['model' => $model, 'dataProvider' => $dataProvider]);
    }

    /**
     * 创建许可
     *
     * @return string
     */
    public function actionPermission_create()
    {
        $model = new Auth_item();
        if (\Yii::$app->request->isPost) {
            if ($model->permissionCreate(\Yii::$app->request->post())) {
                jump_success(\Yii::t('app','create').\Yii::t('app','success'));
            }
        }
        return $this->render('permission_create', ['model' => $model]);
    }


    /**
     * 许可编辑
     *
     * @return string
     */
    public function actionPermission_update()
    {

        $model = null;
        if (\Yii::$app->request->isGet) {

            $name = \Yii::$app->request->get('name');
            if (empty($name) || trim($name) == "") {
                jump_error(\Yii::t('app', 'Information does not exists!'));
            } else {
                $model = Auth_item::findOne(['name'=>$name]);
            }
        } else if(\Yii::$app->request->isPost){

            $model = new Auth_item();
            if ($model->permissionUpdate(\Yii::$app->request->post())) {
                jump_success(t_arr('app',['update','success'],'','!'));
            }

        }

        return $this->render('permission_update',['model'=>$model]);
    }

    /**
     * 删除许可
     */
    public function actionPermission_delete()
    {
        $model = new Auth_item();
        if ($model->permissionDelete(\Yii::$app->request->get())) {
            jump_success(t_arr('app', ['delete','success'],'','!'));
        } else {
            jump_error(t_arr('app', ['delete','fail'],'','!'));
        }

    }


    /**
     * 配置用户权限组
     *
     * @return string
     */
    public function actionAssign_ment_edit()
    {

        $model = new Auth_assignment();

        if (\Yii::$app->request->isGet) {
            $user_id = \Yii::$app->request->get('user_id');
            if (!$user_id || !User::find($user_id)) {
                jump_error(t_arr('app',['data','does not','exists'],'','!'));
            }


            //角色列表
            $assignMents = $model->getAssignmentByUserid($user_id);
            $assignMentSelectArray = [];
            if (is_array($assignMents) && count($assignMents)) {

                foreach ($assignMents as $_key => $_value){
                    $assignMentSelectArray[] = $_key;
                }

            }
            //所有角色{}
            $allRolesArray = $model->getAllRoles2SelectArray();


            //用户信息
            $user = User::findOne($user_id);

            return $this->render('assign_ment_edit',
                                    [
                                        'model' => $model,
                                        'user' => $user,
                                        'assignMentSelectArray' => $assignMentSelectArray,
                                        'allRolesArray' => $allRolesArray
                                    ]
                                );

        } else if(\Yii::$app->request->isPost){

            $rs = $model->assign_user_create(\Yii::$app->request->post());

            if($rs)
                jump_success(t_arr('app',['update','success'],'','!'));
            else
                jump_error(t_arr('app',['update','fail'],'','!'));
        }
    }

    /**
     * 子节点列表页
     *
     * @return string
     */
    public function actionRole_child()
    {

        $model = new Auth_item_child();

        $error = '';

        if(\Yii::$app->request->isPost){

            try {

                $rs = $model->addChild(\Yii::$app->request->post());
                if ($rs) {
                    jump_success(t_arr('app',['add', 'success'],'','!'));
                }
            } catch (Exception $e) {
                $model->addError('child', $e->getMessage());
            }

        }

        //子节点列表
        $name = \Yii::$app->request->get('name');
        $childList = $model->getChildListByName( $name );



        return $this->render('role_child', ['model'=>$model, 'childList'=>$childList, 'name'=>$name]);

    }


    public function actionRole_child_delete()
    {

        $parent = $child = null;
        $model = new Auth_item_child();

        if (\Yii::$app->request->isGet && ($parent = \Yii::$app->request->get('parent')) && $child = \Yii::$app->request->get('child')) {

            $parent = urldecode($parent);
            $child = urldecode($child);
            if ( $model->deleteChild( $parent, $child ) ) {
                jump_success(t_arr('app', ['delete', 'success'],'','!' ));
            }
        }

        $error = $model->getFirstError('error')?: t_arr('app', ['delete','fail'], '','!');
        jump_error($error);

    }


}