<?php

    use yii\helpers\Html;

    $form = \yii\bootstrap\ActiveForm::begin([
        'options' => ['class' => 'p20']
    ]);
?>

    <?=$form->field($model, 'username')->textInput(['placeholder' => '请输入用户名!']) ?>
    <?=$form->field($model, 'password')->textInput(['placeholder' => '请输入密码!']) ?>

    <?=Html::submitButton('创建用户', ['class' => 'btn btn-primary']) ?>
<?php
    $form->end();
?>