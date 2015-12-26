<?php
    use yii\helpers\Html;
?>

<div class="p20">

<?php
    $form = \yii\widgets\ActiveForm::begin([
        'options' => []
    ]);
?>

        <?=$form->field($model, 'category_name')?>

        <?php
            if( !empty($model->category_id) ):
        ?>
                <?=$form->field($model, 'category_id')->hiddenInput()->label('',['class'=>'hidden']);?>
        <?php
            endif;
        ?>


        <?=$form->field($model, 'parent_id')->
                                dropDownList( $dropdownListData );
        ?>

        <?=$form->field($model, 'state')->radioList([CONST_STATE_ENABLE=>'使用', CONST_STATE_DISABLE=>'停用'])?>

        <?=$form->field($model, 'ord')->textInput(['value' => \app\modules\admin\models\Category::DEFAULT_ORD])?>

        <?=$form->field($model, 'genre_id')
                ->dropDownList(
                    array_merge(
                        ['0' => '请选择'],
                        \yii\helpers\ArrayHelper::map(
                            \app\modules\admin\models\Genre::find()->all(), 'genre_id', 'genre_name'
                        )
                    )
                );
        ?>

        <?=Html::submitButton(empty($model->category_id) ? t('app','create') : t('app','udpate'),['class'=>'btn btn-primary']) ?>
<?php
    $form->end();
?>


</div>