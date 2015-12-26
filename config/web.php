<?php

use app\modules\adminshop\models\Admin_user;

require ("../ext/common/function.php");
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),

    'language' => 'zh-CN',

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'abc',

            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false
        ],
        'view' => [
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                    //'cachePath' => '@runtime/Smarty/cache',
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        //商城用户
        'shop_user' => [
            'class'             => '\yii\web\User',
            'identityClass' => 'app\modules\shop\models\Users',
            'idParam'           => '_shopUserId',
            'identityCookie'    => ['name'=>'_shop_user','httpOnly' => true],
        ],
        //商城管理员
        'shop_admin_user' => [
            'class'             => '\yii\web\User',
            'identityClass' => 'app\modules\adminshop\models\Admin_user',
            'idParam'           => '_shopAdminId',
            'identityCookie'    => ['name'=>'_shop_admin','httpOnly' => true],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),


        'urlManager'=>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],


                "<controller:\w+>/<action:\w+>/<id:\d+>"=>"<controller>/<action>",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
                "<module:\w+>/<controller:\w+>/<action:\w+>"=>"<module>/<controller>/<action>",

                "<controller:\w+>/<action:\w+>"=>"shop/<controller>/<action>",



            ],
        ],



        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],


        //定义国际语言source包
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',   //使用php文件保存信息
                    'basePath' => '@app/messages',  //php文件保存位置
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],'web*' => [
                    'class' => 'yii\i18n\PhpMessageSource',   //使用php文件保存信息
                    'basePath' => '@app/messages',  //php文件保存位置
                    //'sourceLanguage' => 'en',
                    'fileMap' => [
                        'webinfo' => 'webinfo.php',
                        'users' => 'users.php',
                    ],
                ],'user*' => [
                    'class' => 'yii\i18n\PhpMessageSource',   //使用php文件保存信息
                    'basePath' => '@app/messages',  //php文件保存位置
                ],
            ],
        ],

        /*//从tp移植过来的跳转功能
        'jump'=>array(
            'class'=>'ext.jumpage.jumpage',
            'successWait'=>5,//成功提示等待跳转时间，可以不指定，默认是2秒
            'errorWait'=>6 //错误信息等待跳转时间，同上，默认3秒
        ),*/

    ],

    'controllerMap' => [
        // 用类名申明 "account" 控制器
        'account' => 'app\modules\admin\controllers\DefaultController',

        // 用配置数组申明 "article" 控制器
        'article' => [
            'class' => 'app\controllers\PostController',
            'enableCsrfValidation' => false,
        ],
    ],

    'params' => $params,

    'bootstrap' => ['log'],
    'modules' => [
        'debug' => 'yii\debug\Module',
        'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1'],


        'admin' => array(
            'class' => 'app\modules\admin\AdminModule',
        ),

        'adminshop' => array(
            'class' => 'app\modules\adminshop\AdminshopModule'
        ),

        'shop' => [
            'class' => 'app\modules\shop\ShopModule'
        ],
    ],

    //定义别名
    'aliases'   =>  [
        '@admin_path'   =>  '/modules/admin'
    ],

    'defaultRoute' => 'shop/index',


];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment

   $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
