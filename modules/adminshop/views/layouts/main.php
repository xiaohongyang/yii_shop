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

<?=Yii::$app->view->renderFile(Yii::$aliases['@moduleViewPath']."/public/header.php") ?>

<?php $this->beginBody();?>


<div class="wrapper">

    <?=$content?>

</div>





<?=Yii::$app->view->renderFile(Yii::$aliases['@moduleViewPath']."/public/footer.php") ?>

<?=Html::jsFile("@web/ecshop/js/admin/validator.js") ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>