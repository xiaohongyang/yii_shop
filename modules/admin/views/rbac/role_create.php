<?php
    use yii\helpers\Html;
?>



<?php
    $form = \yii\bootstrap\ActiveForm::begin([
        'options' => ['class' => 'p20']
    ]);
?>

    <h3 class="">创建角色</h3>

    <?=$form->field($model, 'name')->textInput(['placeholder' => '请输入角色英文名']); ?>
    <?=$form->field($model, 'description')->textInput(['placeholder' => '请输入角色中文注释']); ?>


    <?=Html::submitButton(Yii::t('app','create'), ['class' => 'btn btn-primary']) ?>
<?php
    $form->end();
?>