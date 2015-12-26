<?php

use \yii\helpers\Html;
use \yii\helpers\Url;

?>

<div class="p20">

<?php
    $form = \yii\widgets\ActiveForm::begin([
            'options' => ['class'=> 'form-inline']
    ]) ;
?>



        <div class="form-group">

            <label class="control-label" for="auth_item-name"> name </label>
            <input type="text" id="auth_item-name" class="form-control" name="name" placeholder="请输入要查询的内容" />

            <input type="submit" value="查 询" class="btn btn-primary form-control" />


            <div class="help-block"></div>

            &nbsp;&nbsp;
        </div>

<?php
    $form->end();
?>

</div>


<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'p20'],
    'columns' => [
        ['class' => 'yii\grid\Serialcolumn'],

        [
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->name;
            },
            'attribute' => 'name'
        ],

        [
            'class' => \yii\grid\DataColumn::className(),
            'attribute' => 'description'
        ],

        [
            'class' => \yii\grid\ActionColumn::className(),

            'buttons' => [
                'view' => function () {
                   return '';
                },
                'update' => function ($url, $model, $key) {

                    $name = $model->name;
                    $url = Url::to(['rbac/permission_update','name'=>$name]);
                    return Html::a(' ', $url, ['class' => 'glyphicon glyphicon-pencil']);
                },

                'delete' => function ($url, $model, $key) {

                    $name = $model->name;
                    $url = Url::to(['rbac/permission_delete', 'name'=>$name]);
                    return Html::a(' ', $url, ['class' => 'glyphicon glyphicon-trash event-delete-confirm' ]);
                }

            ]
        ]


    ]
]);

?>


<?php
    \Yii::$app->getView()->on(\yii\web\View::EVENT_END_PAGE, function () {
        $str = <<<STD
                    <script type="text/javascript">
                        !$(function(){

                            $(".event-delete-confirm").bind('click', function (){

                                return window.confirm("确定要删除吗");

                            })

                        });

                    </script>
STD;
        echo $str;
    },null,false);
?>

