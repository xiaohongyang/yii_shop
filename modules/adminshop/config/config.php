<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 9:01
 */


use app\modules\adminshop\models\Admin_user;

$config = [


    'components' => [


    ],
    'params' =>  [
        'name'  =>  '肖红阳'
    ],

    'defaultRoute'  =>  'index',

    'aliases'   =>  [
        '@webName'   =>  '网站管理后台'
    ]

];



return $config;