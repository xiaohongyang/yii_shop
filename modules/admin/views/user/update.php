<?php
    $form = \yii\widgets\ActiveForm::begin([
        'options' => ['class'=>'p20']
    ]);
?>

<?=$form->field($model, 'id')->hiddenInput(['value' => $model->id ])->label(false)?>
<?=$form->field($model, 'username')->textInput(['value' => $model->username, 'readonly' => 'readonly']); ?>
<?=$form->field($model, 'password')->textInput(['placeholder' => "为空则不修改密码",'value'=>'']); ?>
<?=$form    ->field(    $model,
                        'group'

                    )
            ->radioList(    [1=>'超级管理员', 2=>'普通管理员'],
                            [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $checkedStr =  $checked?'checked = checked':'';

                                    $return = '<label class="modal-radio " >';
                                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . ' " '.$checkedStr.' tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords($label) . '</span>';
                                    $return .= '</label>';

                                    return $return;
                                }
                            ]
                            )
           ->label(false);
?>

<?=\yii\helpers\Html::submitButton('提交', ['class'=>'btn btn-primary'])?>

<?php
    $form->end();
?>