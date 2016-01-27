<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets\adminshop;

use yii\web\AssetBundle;
use app\assets\admin;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
	
		//模板css  	begin
		
		//<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />*@
		//<link href="http://fonts.useso.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		"source/global/plugins/font-awesome/css/font-awesome.min.css" ,
		"source/global/plugins/simple-line-icons/simple-line-icons.min.css" ,
		"source/global/plugins/bootstrap/css/bootstrap.min.css" ,
		"source/global/plugins/uniform/css/uniform.default.css" ,
		"source/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" ,
		//END GLOBAL MANDATORY STYLES //
		//BEGIN PAGE LEVEL PLUGIN STYLES //
		"source/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" ,
		"source/global/plugins/fullcalendar/fullcalendar.min.css" ,
		"source/global/plugins/jqvmap/jqvmap/jqvmap.css" ,
		//END PAGE LEVEL PLUGIN STYLES //
		//BEGIN PAGE STYLES // 
		 
		"assets/admin/pages/css/tasks.css" ,
		//END PAGE STYLES //
		//BEGIN PAGE LEVEL STYLES //
		"source/global/plugins/select2/select2.css",
		"source/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css",

		"source/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css",
		"source/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css",
		"source/global/plugins/fancybox/source/jquery.fancybox.css",


		"source/global/plugins/bootstrap-select/bootstrap-select.min.css",
		//END PAGE LEVEL STYLES //
		 
		//BEGIN THEME STYLES //
		"source/global/css/components.css" ,
		"source/global/css/plugins.css" ,
		"source/global/css/components-md.css" ,


		"source/global/css/plugins-md.css" ,

		"assets/admin/layout/css/layout.css" ,
		"assets/admin/layout/css/themes/darkblue.css" ,
		"assets/admin/layout/css/custom.css" ,


        //for icheck's css begin
		"source/global/plugins/icheck/skins/all.css" ,
        //for icheck's css end

		//模板css 	end
		
	
        'css/site.css',
    ];
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
        "assets/admin/layout/scripts/layout.js" ,
        "assets/admin/layout/scripts/quick-sidebar.js" ,
        "assets/admin/pages/scripts/index.js",
//            <!-- END PAGE LEVEL SCRIPTS -->

        //for icheck's js begin
        "source/global/plugins/icheck/icheck.min.js" ,
        "assets/admin/pages/scripts/form-icheck.js",
        //for icheck's js end


        "source/global/plugins/select2/select2.js"
        //模板js end








        ,"js/common.js"
    ];
    public $depends = [
        //'yii\web\YiiAsset',

        //'app\source\adminshop/YiiAsset',

        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
        //'yii\bootstrap\AwesomeAsset',

        //'app\source\CommonPlugin',

        // 'app\assets\adminshop\Template'
    ];
}
