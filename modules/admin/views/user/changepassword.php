<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">

    <div>

        <?php $form = ActiveForm::begin([
                'options' => ['class' => 'p20']
            ]);?>

        <?=$form->field($model, 'old_password')->textInput(['placeholder'=>'请输入原来密码'])?>
        <?=$form->field($model, 'new_password')->textInput(['placeholder'=>'请输入新的密码'])?>
        <?=$form->field($model, 'repeat_password')->textInput(['placeholder'=>'确认密码'])?>

        <?=Html::submitButton("修改", ['class' => 'btn btn-primary'])?>

        <?php $form->end() ?>

        <div class="fa-codepen">

            <?=$msg?:$msg;?>
        </div>

    </div>

</div>