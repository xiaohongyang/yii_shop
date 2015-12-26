<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 16:18
 */

namespace app\modules\adminshop\controllers;


use app\modules\adminshop\models\Language;
use app\modules\adminshop\models\Shop_config;
use app\modules\adminshop\models\Uploadform;
use yii\web\Response;
use yii\web\UploadedFile;

class Shop_configController extends BaseController{


    private $viewBag = null;

    public function init()
    {
        parent::init();


    }

    public function actionList_edit()
    {


        //配置列表
        $model = new Shop_config();
        $settingList = $model->get_settings(null, [5]);

        //可选语言
        $language = new Language();
        $lang_list = $language->get_lang_list();


        //rewrite_confirm
        if (strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'iis') !== false)
        {
            $rewrite_confirm = $this->_lang['rewrite_confirm_iis'];
        }
        else
        {
            $rewrite_confirm = $this->_lang['rewrite_confirm_apache'];
        }

        //
        if ($this->_cfg['shop_country'] > 0)
        {
            $this->viewBag['provinces'] = get_regions(1, $this->_cfg['shop_country']);

            if ($this->_cfg['shop_province'])
            {
                $this->viewBag['cities'] = get_regions(2, $this->_cfg['shop_province']);
            }
        }

        $this->viewBag['cfg'] = $this->_cfg;
        $this->viewBag['lang_list'] = $lang_list;
        $this->viewBag['ur_here'] = $this->_lang['01_shop_config'];
        $this->viewBag['group_list'] = $settingList;

        $this->viewBag['rewrite_confirm'] = $rewrite_confirm;
        $this->viewBag['countries'] = get_regions();

        assign_query_info();


        if (\Yii::$app->request->isPost) {

            $post = \Yii::$app->request->post();


            $valueArr = $post['value'];
            $upFormArr = $post['UploadForm'];

            $uploadFormModel = new Uploadform();

            //更新上传文件缓存表
            foreach ($upFormArr as $k=>$file_name) {

                $column_value = null;
                if ( $file_name && $column_value = array_keys($valueArr, $file_name) ) {

                    $uploadFormModel->updateColumnValue($column_value, $file_name);
                }

            }



        }


        return $this->render('list_edit',['viewBag'=>$this->viewBag]);
    }

    public function actionUpload()
    {
        $params = \Yii::$app->request->post();

        $name = $params['name'];
        $filetype = $params['filetype'];



        if (\Yii::$app->request->isPost) {

            $model =  new Uploadform();
            $model->setFileTableName($model::TABLE_NAME_SHOP_CONFIG);
            $model->file = UploadedFile::getInstance($model, $name);

            if ($model->file) {

                $data = array();
                $data[$model->formName()]['table_name'] = $model->getFileTableName();
                $data[$model->formName()]['file_type'] = $filetype?:$model::FILE_TYPE_IMAGE;
                $data[$model->formName()]['file_ext'] = $model->file->getExtension();


                if ($id = $model->create($data)) {

                    $file = $model->file_dir.$model->file_name;
                    $file = \Yii::getAlias($file);
                    $rs = $model->file->saveAs($file);


                    $data = [
                        'file_name' => $model->file_name,
                        'img_src' =>  getImageHost().$model->getDir().$model->file_name
                    ];
                    returnJson(1, '成功!', $data);
                } else {
                    $errors = $model->getFirstErrors();
                    $errorInfo = array_shift($errors);
                    returnJson(0, '失败!'.$errorInfo);
                }

                return;
            }

        }

        returnJson(0, '失败,请选择要上传的文件!');
    }

    public function actionTest()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        \Yii::$app->response->data = [
            'status' => 3,
            'message' => 321,
            'data' => 321,
            'url' => 321
        ];

    }

}