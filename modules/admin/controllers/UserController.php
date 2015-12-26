<?php
/**
 * 用户管理
 * User: xiaohongyang
 * Date: 2015/6/11
 * Time: 21:05
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Test;
use app\modules\admin\models\Test2;
use app\modules\admin\models\User;
use app\modules\admin\models\UserAdver;
use app\modules\admin\models\Usermodify;

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

                'username'    =>  'admin',
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

        $model = new User;
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

            $model = User::findOne(\Yii::$app->request->get('id'));
            if (!$model) {
                jump_error('数据不存在!', '/');
            }

        } else if (\Yii::$app->request->isPost) {

            $model = new User();
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

        $model = new User();
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

    /**
     * 修改密码
     *
     * @return string
     */
    public function actionChangepassword()
    {


        $model = new User();

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


    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id');

        $user = new User();
        if ($user->deleteOne($id)) {
            jump_success('删除成功!');
        } else {
            jump_error($user->getFirstError(User::DELETE_EFFOR_INFO));
        }
    }

}