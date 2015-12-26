<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 15:23
 */
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>


<div class="container">


    <div class="public-login">

        <table class="table bordered">
            <?php
                $form = ActiveForm::begin();
            ?>
            <thead>
                用户登录
            </thead>

            <tr>
                <td>
                    <?=$form->field($model, 'user_name')->textInput()?>
                </td>
            </tr>

            <tr>
                <td>
                    <?=$form->field($model, 'password')->textInput()?>
                </td>
            </tr>

            <tr>
                <td>
                    <?=$form->field($model, 'captcha')->widget(Captcha::className(),[
                        'captchaAction' => 'public/captcha'
                    ])?>
                </td>
            </tr>

            <tr>
                <td>
                    <?=Html::submitButton('登 录', ['class'=>'btn btn-primary'])?>
                </td>
            </tr>

            <?php
                ActiveForm::end();
            ?>
        </table>

    </div>

</div>