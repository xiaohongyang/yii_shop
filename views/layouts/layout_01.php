<?php
use yii\helpers\Html;
?>
<?php
$this->beginPage();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <?=Html::tag('meta','',['charset'=>'utf-8']) ?>
    <?=Html::csrfMetaTags() ?>
    <title><?=Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?=$this->beginBody() ?>
    <header>My Project</header>
    <?=$content ?>
    <footer>
        &copyright 2015 by Jack
    </footer>

    <?php $this->endBody();?>
</body>
</html>
<?php $this->endPage(); ?>