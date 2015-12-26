<?php
    //iframe modal 弹出窗
    app\widgets\ModalWidget::widget();
?>
<?php
    use yii\helpers\Html;

    \app\assets\admin\AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <?=HTML::csrfMetaTags() ?>
    <title><?=$this->title?></title>

    <?php $this->head(); ?>

    <?=Html::cssFile("@web/css/adminshop.css") ?>

    <?=Html::jsFile("@web/ecshop/js/admin/validator.js") ?>

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

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>