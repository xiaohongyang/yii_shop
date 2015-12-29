<?php
    //iframe modal 弹出窗
    app\widgets\ModalWidget::widget();
?>
<?php
    use yii\helpers\Html;

    \app\assets\adminshop\AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <?=HTML::csrfMetaTags() ?>
    <title><?=$this->title?></title>

    <?php $this->head(); ?>

<!--    <link href="http://fonts.useso.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />-->

    <?=Html::cssFile("@web/css/adminshop.css") ?>


    <script type="text/javascript">


        <?php
            if( is_array(Yii::$app->params['lang']) && count(Yii::$app->params['lang'])):
                foreach(Yii::$app->params['lang']['js_languages'] as $_k=>$_v){
        ?>
        var <?=$_k?>="<?=$_v?>";
        <?php
                }
            endif;
        ?>
    </script>



</head>
<body>

<?php $this->beginBody();?>


<!--<div class="wrapper">
    <?/*//=$content*/?>
</div>-->
<div class="page-content-wrapper">
    <div class="page-content" style="min-height:1656px">

        <?=Yii::$app->view->renderFile(Yii::$aliases['@moduleViewPath']."/public/header.php") ?>

        <div class="row">
            <?=$content?>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->


        <!-- END PAGE CONTAINER-->
    </div>
    <!-- BEGIN CONTENT -->
</div>





<?=Yii::$app->view->renderFile(Yii::$aliases['@moduleViewPath']."/public/footer.php") ?>

<?=Html::jsFile("@web/ecshop/js/admin/validator.js") ?>
<?php $this->endBody(); ?>


</body>
</html>
<?php $this->endPage(); ?>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        //Index.init();
        Index.initDashboardDaterange();
        //Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        //Index.initCharts(); // init index page's custom scripts
        //Index.initChat();
        //Index.initMiniCharts();
        //Tasks.initDashboardWidget();
    });

    /**
     Demo script to handle the theme demo
     **/
    var Demo = function() {

        // Handle Theme Settings
        var handleTheme = function() {

            var panel = $('.theme-panel');

            if ($('body').hasClass('page-boxed') === false) {
                $('.layout-option', panel).val("fluid");
            }

            $('.sidebar-option', panel).val("default");
            $('.page-header-option', panel).val("fixed");
            $('.page-footer-option', panel).val("default");
            if ($('.sidebar-pos-option').attr("disabled") === false) {
                $('.sidebar-pos-option', panel).val(Metronic.isRTL() ? 'right' : 'left');
            }

            //handle theme layout
            var resetLayout = function() {
                $("body").
                    removeClass("page-boxed").
                    removeClass("page-footer-fixed").
                    removeClass("page-sidebar-fixed").
                    removeClass("page-header-fixed").
                    removeClass("page-sidebar-reversed");

                $('.page-header > .page-header-inner').removeClass("container");

                if ($('.page-container').parent(".container").size() === 1) {
                    $('.page-container').insertAfter('body > .clearfix');
                }

                if ($('.page-footer > .container').size() === 1) {
                    $('.page-footer').html($('.page-footer > .container').html());
                } else if ($('.page-footer').parent(".container").size() === 1) {
                    $('.page-footer').insertAfter('.page-container');
                    $('.scroll-to-top').insertAfter('.page-footer');
                }

                $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");

                $('body > .container').remove();
            };

            var lastSelectedLayout = '';

            var setLayout = function() {

                var layoutOption = $('.layout-option', panel).val();
                var sidebarOption = $('.sidebar-option', panel).val();
                var headerOption = $('.page-header-option', panel).val();
                var footerOption = $('.page-footer-option', panel).val();
                var sidebarPosOption = $('.sidebar-pos-option', panel).val();
                var sidebarStyleOption = $('.sidebar-style-option', panel).val();
                var sidebarMenuOption = $('.sidebar-menu-option', panel).val();
                var headerTopDropdownStyle = $('.page-header-top-dropdown-style-option', panel).val();

                if (sidebarOption == "fixed" && headerOption == "default") {
                    alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                    $('.page-header-option', panel).val("fixed");
                    $('.sidebar-option', panel).val("fixed");
                    sidebarOption = 'fixed';
                    headerOption = 'fixed';
                }

                resetLayout(); // reset layout to default state

                if (layoutOption === "boxed") {
                    $("body").addClass("page-boxed");

                    // set header
                    $('.page-header > .page-header-inner').addClass("container");
                    var cont = $('body > .clearfix').after('<div class="container"></div>');

                    // set content
                    $('.page-container').appendTo('body > .container');

                    // set footer
                    if (footerOption === 'fixed') {
                        $('.page-footer').html('<div class="container">' + $('.page-footer').html() + '</div>');
                    } else {
                        $('.page-footer').appendTo('body > .container');
                    }
                }

                if (lastSelectedLayout != layoutOption) {
                    //layout changed, run responsive handler:
                    Metronic.runResizeHandlers();
                }
                lastSelectedLayout = layoutOption;

                //header
                if (headerOption === 'fixed') {
                    $("body").addClass("page-header-fixed");
                    $(".page-header").removeClass("navbar-static-top").addClass("navbar-fixed-top");
                } else {
                    $("body").removeClass("page-header-fixed");
                    $(".page-header").removeClass("navbar-fixed-top").addClass("navbar-static-top");
                }

                //sidebar
                if ($('body').hasClass('page-full-width') === false) {
                    if (sidebarOption === 'fixed') {
                        $("body").addClass("page-sidebar-fixed");
                        $("page-sidebar-menu").addClass("page-sidebar-menu-fixed");
                        $("page-sidebar-menu").removeClass("page-sidebar-menu-default");
                        Layout.initFixedSidebarHoverEffect();
                    } else {
                        $("body").removeClass("page-sidebar-fixed");
                        $("page-sidebar-menu").addClass("page-sidebar-menu-default");
                        $("page-sidebar-menu").removeClass("page-sidebar-menu-fixed");
                        $('.page-sidebar-menu').unbind('mouseenter').unbind('mouseleave');
                    }
                }

                // top dropdown style
                if (headerTopDropdownStyle === 'dark') {
                    $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
                } else {
                    $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
                }

                //footer
                if (footerOption === 'fixed') {
                    $("body").addClass("page-footer-fixed");
                } else {
                    $("body").removeClass("page-footer-fixed");
                }

                //sidebar style
                if (sidebarStyleOption === 'light') {
                    $(".page-sidebar-menu").addClass("page-sidebar-menu-light");
                } else {
                    $(".page-sidebar-menu").removeClass("page-sidebar-menu-light");
                }

                //sidebar menu
                if (sidebarMenuOption === 'hover') {
                    if (sidebarOption == 'fixed') {
                        $('.sidebar-menu-option', panel).val("accordion");
                        alert("Hover Sidebar Menu is not compatible with Fixed Sidebar Mode. Select Default Sidebar Mode Instead.");
                    } else {
                        $(".page-sidebar-menu").addClass("page-sidebar-menu-hover-submenu");
                    }
                } else {
                    $(".page-sidebar-menu").removeClass("page-sidebar-menu-hover-submenu");
                }

                //sidebar position
                if (Metronic.isRTL()) {
                    if (sidebarPosOption === 'left') {
                        $("body").addClass("page-sidebar-reversed");
                        $('#frontend-link').tooltip('destroy').tooltip({
                            placement: 'right'
                        });
                    } else {
                        $("body").removeClass("page-sidebar-reversed");
                        $('#frontend-link').tooltip('destroy').tooltip({
                            placement: 'left'
                        });
                    }
                } else {
                    if (sidebarPosOption === 'right') {
                        $("body").addClass("page-sidebar-reversed");
                        $('#frontend-link').tooltip('destroy').tooltip({
                            placement: 'left'
                        });
                    } else {
                        $("body").removeClass("page-sidebar-reversed");
                        $('#frontend-link').tooltip('destroy').tooltip({
                            placement: 'right'
                        });
                    }
                }

                Layout.fixContentHeight(); // fix content height
                Layout.initFixedSidebar(); // reinitialize fixed sidebar
            };

            // handle theme colors
            var setColor = function(color) {
                var color_ = (Metronic.isRTL() ? color + '-rtl' : color);
                $('#style_color').attr("href", Layout.getLayoutCssPath() + 'themes/' + color_ + ".css");
                if (color == 'light2') {
                    $('.page-logo img').attr('src', Layout.getLayoutImgPath() + 'logo-invert.png');
                } else {
                    $('.page-logo img').attr('src', Layout.getLayoutImgPath() + 'logo.png');
                }
            };

            $('.toggler', panel).click(function() {
                $('.toggler').hide();
                $('.toggler-close').show();
                $('.theme-panel > .theme-options').show();
            });

            $('.toggler-close', panel).click(function() {
                alert(321);
                $('.toggler').show();
                $('.toggler-close').hide();
                $('.theme-panel > .theme-options').hide();
            });

            $('.theme-colors > ul > li', panel).click(function() {
                var color = $(this).attr("data-style");
                setColor(color);
                $('ul > li', panel).removeClass("current");
                $(this).addClass("current");
            });

            // set default theme options:

            if ($("body").hasClass("page-boxed")) {
                $('.layout-option', panel).val("boxed");
            }

            if ($("body").hasClass("page-sidebar-fixed")) {
                $('.sidebar-option', panel).val("fixed");
            }

            if ($("body").hasClass("page-header-fixed")) {
                $('.page-header-option', panel).val("fixed");
            }

            if ($("body").hasClass("page-footer-fixed")) {
                $('.page-footer-option', panel).val("fixed");
            }

            if ($("body").hasClass("page-sidebar-reversed")) {
                $('.sidebar-pos-option', panel).val("right");
            }

            if ($(".page-sidebar-menu").hasClass("page-sidebar-menu-light")) {
                $('.sidebar-style-option', panel).val("light");
            }

            if ($(".page-sidebar-menu").hasClass("page-sidebar-menu-hover-submenu")) {
                $('.sidebar-menu-option', panel).val("hover");
            }

            var sidebarOption = $('.sidebar-option', panel).val();
            var headerOption = $('.page-header-option', panel).val();
            var footerOption = $('.page-footer-option', panel).val();
            var sidebarPosOption = $('.sidebar-pos-option', panel).val();
            var sidebarStyleOption = $('.sidebar-style-option', panel).val();
            var sidebarMenuOption = $('.sidebar-menu-option', panel).val();

            $('.layout-option, .page-header-option, .page-header-top-dropdown-style-option, .sidebar-option, .page-footer-option, .sidebar-pos-option, .sidebar-style-option, .sidebar-menu-option', panel).change(setLayout);
        };

        // handle theme style
        var setThemeStyle = function(style) {
            var file = (style === 'rounded' ? 'components-rounded' : 'components');
            file = (Metronic.isRTL() ? file + '-rtl' : file);

            $('#style_components').attr("href", Metronic.getGlobalCssPath() + file + ".css");

            if ($.cookie) {
                $.cookie('layout-style-option', style);
            }
        };

        return {

            //main function to initiate the theme
            init: function() {
                // handles style customer tool
                handleTheme();

                // handle layout style change
                $('.theme-panel .layout-style-option').change(function() {
                    setThemeStyle($(this).val());
                });

                // set layout style from cookie
                if ($.cookie && $.cookie('layout-style-option') === 'rounded') {
                    setThemeStyle($.cookie('layout-style-option'));
                    $('.theme-panel .layout-style-option').val($.cookie('layout-style-option'));
                }
            }
        };

    }();


    $('.toggler-close', $('.theme-panel')).click(function() {
        $('.toggler').show();
        $('.toggler-close').hide();
        $('.theme-panel > .theme-options').hide();
    });
</script>