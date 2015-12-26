<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/13
 * Time: 12:39
 */
namespace app\assets\admin;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{

    public $basePath = "@webroot";

    public $baseUrl = "@web";

    public $css = [
        "source/admin/css/common.css",
    ];

}