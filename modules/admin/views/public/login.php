<?php
use yii\captcha\Captcha;
use yii\helpers\Html;

?>

<?=Html::cssFile("@web/source/admin/css/public/login.css") ?>

<div class="container">

    <div class="row">

        <div class="  logcen test">


            <?php $form = \yii\widgets\ActiveForm::begin([
//            'method'    =>  'post',
//            'action'    =>  [Url::current()],

                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    'inputOptions' => ['class' => 'form-control'],
                ],
                'enableAjaxValidation' => false
            ]); ?>
            <div class="">
                <h3 class="col-md-offset-1"><?=Yii::t('webinfo','webname')?><?=Yii::t('webinfo','backForm')?>:</h3>

                <div class="margin-top-small" style="margin-top: 40px;"> </div>

                <?= $form->field($model, 'username')->textInput(['placeholder'=>'请输入用户名']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入密码']) ?>

                <?php

                    $template = <<<STD
                        <div class="form-group field-user-password required has-error">
                            <div class="col-lg-6">{input}</div>
                            <label class="col-lg-3 control-label" for="user-password">{image}</label>
                        </div>
STD;
                    echo $form->field($model, 'captcha')->widget(Captcha::className(),[

                    //configure
                    'captchaAction' => '/admin/public/captcha',
//                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    'template' => $template,

                    'imageOptions' => [
                        'style' => 'width: 80px; height: 30px;'
                    ]

                ])?>

                <div class="form-group">

                    <!--<input type="submit" value="登录" class="btn btn-success center-block">-->

                    <div class="col-lg-offset-3 col-lg-11">
                        <?= Html::submitInput('登录', [
                            'class' => 'btn btn-success '
                        ]); ?>
                    </div>
                </div>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>

</div>



