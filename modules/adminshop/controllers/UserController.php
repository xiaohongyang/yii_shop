<?php
/**
 * 用户管理
 * User: xiaohongyang
 * Date: 2015/6/11
 * Time: 21:05
 */

namespace app\modules\adminshop\controllers;


use app\modules\adminshop\models\Test;
use app\modules\adminshop\models\Test2;
use app\modules\adminshop\models\Admin_user;
use app\modules\adminshop\models\UserAdver;
use app\modules\adminshop\models\Usermodify;

use yii\data\ActiveDataProvider;
use yii\web\UrlManager;
use yii\widgets\ListView;

class UserController extends BaseController{

    public $username;
    public $group;

    public function init()
    {

    }


    /**
     * 创建用户
     *
     */
    public function actionCreate()
    {


        /*$data = [
            'user' =>[

                'username'    =>  'adminshop',
                'password'   =>  'abcabc',
                'group'   =>  1,
            ]
        ];

        $user = new User();


        $rs = $user->addOne($data);


        p($rs);

        if (!$rs) {
            p($user->errors);
        }
        exit;*/

        $model = new Admin_user;
        if (\Yii::$app->request->isPost) {

            if ($model->addOne(\Yii::$app->request->post())) {
                jump_success('创建用户成功!');
            }

        }

        return $this->render('create', ['model'=> $model]);

    }

    public function actionUpdate()
    {


        if (\Yii::$app->request->isGet) {

            $model = Admin_user::findOne(\Yii::$app->request->get('id'));
            if (!$model) {
                jump_error('数据不存在!', '/');
            }

        } else if (\Yii::$app->request->isPost) {

            $model = new Admin_user();
            $post = \Yii::$app->request->post();

            if ($model->updateOne($post[$model->formName()]['id'], $post)) {
                jump_success('修改成功!');
            } else {
                jump_error('修改失败!');
            }
        }


        return $this->render('update', ['model' => $model]);
    }

    /**
     * 用户列表
     *
     * @return string
     */
    public function actionList()
    {

        $model = new Admin_user();
        $dataProvider = new ActiveDataProvider([
            'query' => $model->find(),
            'pagination' => [

                'pagesize' => 2
            ]
        ]);

        return $this->render('list', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);

    }

    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id');

        $user = new Admin_user();
        if ($user->deleteOne($id)) {
            jump_success('删除成功!');
        } else {
            jump_error($user->getFirstError(Admin_user::DELETE_EFFOR_INFO));
        }
    }


    /**
     * 修改密码
     *
     * @return string
     */
    public function actionChangepassword()
    {


        $model = new Admin_user();

        $params = array();
        $msg = "";
        if (\Yii::$app->request->isPost  &&  $params=\Yii::$app->request->post()) {

            $model = $model->savePassword($params);
            if (!$model->hasErrors()) {
                $msg = "修改成功~";
            }
        }

        return $this->render('changepassword',[
            'model' => $model,
            'msg'   => $msg
        ]);
    }

}