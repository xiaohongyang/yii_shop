<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/26
 * Time: 16:46
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\Arctype;
use app\modules\admin\models\Category;
use app\modules\admin\models\Order;
use yii\base\Object;
use yii\helpers\ArrayHelper;

class CategoryController extends BaseController{

    public $model=null;
    public function init()
    {
        $this->model = new Category();
    }

    //列出所有类别
    public function actionIndex()
    {


        $list = $this->model->getListtree2Linear();

        foreach ($list as &$item) {
//            $item = $item['getModel'];
        }


        return $this->render('index', ['model'=> $this->model, 'list' => $list]);
    }

    //创建
    public function actionCreate()
    {

        if (\Yii::$app->request->isPost) {

            if ($this->model->create(\Yii::$app->request->post())) {
                jump_success(t_arr('app',['create','success'],'','!'));
            }
        }


        $this->model->state = CONST_STATE_ENABLE;

        return $this->render('create', ['model'=> $this->model, 'dropdownListData' => $this->model->getDropdownData()]);

    }


    //更新
    public function actionUpdate()
    {

        $category_id = null;
        if (\Yii::$app->request->isGet && $category_id = \Yii::$app->request->get('id'))
            $this->model = $this->model->findOne($category_id);

        else if (\Yii::$app->request->isPost ) {

            $formName = $this->model->formName();
            $id = \Yii::$app->request->post($formName)['category_id'];

            $this->model = $this->model->findOne($id);

            if ($this->model->edit(\Yii::$app->request->post())) {
                jump_success( t_arr('app', ['edit', 'success'], '', '!') );
            }
        } else {
            jump_error('数据不存在!');

        }


        return $this->render('create', ['model' => $this->model, 'dropdownListData' => $this->model->getDropDownData()]);

    }

    //删除
    public function actionDelete()
    {

        $category_id = null;
        if (\Yii::$app->request->isGet && $category_id = \Yii::$app->request->get('id')) {

            if ($this->model->remove($category_id)) {
                jump_success(t_arr('app', ['delete', 'success'], '', '!'));
            } else {

                jump_error($this->model->getFirstError('category_id')?:$this->model->getFirstError('error'));
            }
        }
    }

}