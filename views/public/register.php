<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/28
 * Time: 23:04
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $GLOBALS['_LANG']['label_regist'];


$this->params['breadcrumbs'][] = $this->title;
?>

<div class="public-register">

    <div class="container">

        <div class="register-form">

            <?php
                $form = ActiveForm::begin([

                ]);
            ?>

                <?=$form->field($model, 'user_name')->textInput()?>
                <?=$form->field($model, 'email')->textInput()?>
                <?=$form->field($model, 'password')->passwordInput()?>



            <?=Html::submitInput("立即注册", ['class'=>'btn btn-primary']);?>

            <?php
            ActiveForm::end();
            ?>
        </div>

    </div>

</div>


