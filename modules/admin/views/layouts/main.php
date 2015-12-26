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
</head>
<body>
<?php $this->beginBody();?>
    <?= $content ?>
<?php $this->endBody(); ?>

</body>
</html>
<?php $this->endPage(); ?>



