<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>

<span><?=Yii::$app->session->getFlash('success')?></span>

<?php $form = ActiveForm::begin() ?>

<?=$form->field($model, "name") ?>
<?=$form->field($model, "email") ?>

<?=Html::submitButton("提交",['class'=>'btn btn-success btn-xs']) ?>

<?php $form->end(); ?>