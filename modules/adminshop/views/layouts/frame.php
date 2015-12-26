<?php
    use yii\helpers\Html;
    \app\assets\admin\ToFrameAsset::register($this);
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
    <footer>&copy; 2014 by My Company</footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>