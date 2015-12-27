<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/12/27
 * Time: 16:50
 */

namespace app\assets\adminshop;


class YiiAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';

    public $js = [
        'yii.js',
    ];

    public $depends = [
        //'yii\web\JqueryAsset',
    ];
}
