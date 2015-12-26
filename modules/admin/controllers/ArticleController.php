<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/14
 * Time: 10:14
 */

namespace app\modules\admin\controllers;


class ArticleController extends BaseController{

    /**
     * 文章列表
     * @return string
     */
    public function actionArticles()
    {



        return $this->render('articles');
    }

}