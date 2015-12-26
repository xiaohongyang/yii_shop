

<?php

    use yii\helpers\Html;



?>


<!--   添加角色  -->
<?php
    $form = \yii\widgets\ActiveForm::begin([
       'options' => ['class'=>'p20']
    ]);
?>

    <?php

    ?>
    <h3><?=t_arr('app',['user','role','edit'],'',':')?> <?=$user->username?></h3>
    <?=$form->field($model, 'user_id')->textInput([
                                            'placeholde' => 'placeholde',
                                            'value' => $user->id
                                        ]) ?>


    <?=Html::checkboxList($model->formName().'[item_name][]',$assignMentSelectArray, $allRolesArray);?>


    <?=Html::submitButton(t('app','update'),['class' => 'btn btn-primary']) ?>


<?php
    $form->end();
?>