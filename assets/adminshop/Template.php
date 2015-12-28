<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/12/27
 * Time: 16:50
 */
namespace app\assets\adminshop;


use yii\web\AssetBundle;

class Template extends AssetBundle
{
    public $sourcePath = '@webroot';
    public  $baseUrl = '@web';
    public $js = [
        //模板js begin

        "source/global/plugins/jquery.min.js" ,
//            <!-- END THEME STYLES -->
//            <!--custome style-->
//            <link href="~/Content/Site.css" type="text/css" rel="stylesheet" />
//            <!--end custome style-->
//            <link rel="shortcut icon" href="favicon.ico" />
//            <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
//            <!-- BEGIN CORE PLUGINS -->

        "source/global/plugins/jquery-migrate.min.js" ,
//            <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        "source/global/plugins/jquery-ui/jquery-ui.min.js" ,
        "source/global/plugins/bootstrap/js/bootstrap.min.js" ,
        "source/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" ,
        "source/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" ,
        "source/global/plugins/jquery.blockui.min.js" ,
        "source/global/plugins/jquery.cokie.min.js" ,
        "source/global/plugins/uniform/jquery.uniform.min.js" ,
        "source/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" ,
//            <!-- END CORE PLUGINS -->

//            <!-- BEGIN PAGE LEVEL PLUGINS -->
        "source/global/plugins/flot/jquery.flot.min.js" ,
        "source/global/plugins/flot/jquery.flot.resize.min.js" ,
        "source/global/plugins/flot/jquery.flot.categories.min.js" ,
        "source/global/plugins/jquery.pulsate.min.js" ,
        "source/global/plugins/bootstrap-daterangepicker/moment.min.js" ,
        "source/global/plugins/bootstrap-daterangepicker/daterangepicker.js" ,
//            <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
        "source/global/plugins/fullcalendar/fullcalendar.min.js" ,
        "source/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" ,
        "source/global/plugins/jquery.sparkline.min.js" ,
//            <!-- END PAGE LEVEL PLUGINS -->

//            <!-- BEGIN PAGE LEVEL SCRIPTS -->
        "source/global/scripts/metronic.js" ,
        "source/admin/layout/scripts/layout.js" ,
        "source/admin/layout/scripts/quick-sidebar.js" ,
        "source/admin/pages/scripts/index.js"
//            <script src="~/Scripts/onedesk.js" ,
//            <!-- END PAGE LEVEL SCRIPTS -->
        //模板js end
    ];

    public $depends = [
        //'yii\web\JqueryAsset',
    ];
}
