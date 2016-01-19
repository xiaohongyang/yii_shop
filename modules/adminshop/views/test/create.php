<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl('adminshop/test/create'), "options"=>
        ["class"=>"form-horizontal"]
    ])
?>

    <?php
        $nameFiled = $form->field($model,   'name',
                                            [
                                                'labelOptions' => ['class'=>'col-md-3 control-label']
                                            ]);
        $nameFiled->template = "{label} <div class='col-md-4'> {input} {error} </div>";
        echo $nameFiled;
    ?>


    <?php
        $field = $form->field($model,   'email',
                                        [   'options' => ['class' => 'form-group '],
                                            'labelOptions'=>['class' => 'col-md-3 control-label']
                                        ]);
        $field->template = "{label}<div class='col-md-4'>\n{input}\n{error}</div>";
        echo $field->textInput(['maxlength' => 15]);
    ?>


    <?=$form->errorSummary($model,['name','emial','created_on']);?>

    <div class="form-group">
        <div class="col-md-4 text-right">
            <?=Html::submitButton("提交", ["class"=>"btn btn-success"]) ?>
        </div>
    </div>

<?php
$form::end();
?>
