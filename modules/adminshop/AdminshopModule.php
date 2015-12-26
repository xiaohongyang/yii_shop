<?php

namespace app\modules\adminshop;
use app\modules\adminshop\models\Shop_config;
use yii\base\Module;

defined('IN_ECS') || define('IN_ECS', true);
defined('EC_PATH') || define('EC_PATH', '../ext/ecshop');

//ECSHOP 常量库
require_once( EC_PATH."/include/inc_constant.php" );

//ECSHOP 基础类
require_once( EC_PATH."/include/cls_ecshop.php" );

//前台语言库
require_once( EC_PATH."/include/lang_common.php" );

//ECSHOP 时间函数库
require_once( EC_PATH."/include/lib_time.php" );

//ECSHOP 基础函数库
require_once( EC_PATH."/include/lib_base.php" );

//ECSHOP 公用函数库
require_once( EC_PATH."/include/lib_common.php" );

//ECSHOP 模板函数
require_once( EC_PATH."/include/cls_template.php" );

//ECSHOP 管理中心公用函数库
require_once( EC_PATH."/include/adminshop/lib_main.php" );

//ECSHOP 后台自动操作数据库的类文件
require_once( EC_PATH."/include/adminshop/cls_exchange.php" );






/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 14:49
 */

class AdminshopModule extends Module{

    public $controllerNamespace = 'app\modules\adminshop\controllers';

    /**
     * 模块初始化
     */
    public function init()
    {


        parent::init();
        // custom initialization code goes here


        $config = [


            'components' => [


            ],
            'params' =>  [
                'name'  =>  '肖红阳'
            ],

            'defaultRoute'  =>  'index',

            'aliases'   =>  [
                '@webName'   =>  '网站管理后台',
                '@moduleViewPath' => '@app/modules/adminshop/views'
            ]

        ];


        \yii::configure($this, $config);

        $this->ec_init();

    }

    /**
     * 载入ecshop init
     */
    public function ec_init()
    {
        /* 载入系统参数 */
        $Shop_configModel = new Shop_config();
        Global $_CFG;
        Global $_LANG;
        $_CFG = $Shop_configModel->load_config();

        $this->ec_language();

        $this->_aliase();

    }

    /**
     * 载入语言包
     *
     */
    public function ec_language()
    {
        Global $_CFG;
        Global $_LANG;

        //ECSHOP 管理中心共用语言文件
        require_once(EC_PATH."/languages/".$_CFG['lang']."/admin/common.php");

        //ECSHOP 管理中心管理员操作内容语言文件
        require_once(EC_PATH."/languages/".$_CFG['lang']."/admin/log_action.php");

    }

    private function _aliase()
    {
        $this->setAliases(['@ecshopImg' => '/ecshop/images']);
    }


}