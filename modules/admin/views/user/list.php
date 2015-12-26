<?php

use \yii\helpers\Html;


echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'p20'],
    'columns' => [
        ['class' => 'yii\grid\Serialcolumn'],
        'id',
        'username',

        [
            'class' => 'yii\grid\DataColumn',
            'value' => function ($data) {
                return $data->status==0?'未启用':"已启用";
            },
            'attribute' => 'status'
        ],

        [
            'class' => \yii\grid\DataColumn::className(),
            'value' => function ($data) {
                return date('Y-m-d H:i', $data->created_at);
            },
            'attribute' => 'created_at'
        ],
        [
            'class' => \yii\grid\DataColumn::className(),
            'attribute' => 'group',
            'value' => function ($model) {
                return $model->group==1? '超级管理员' : '普通管理员';
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{audit}   {delete}',
            'buttons' => [
                'audit' => function ($url, $model, $key) {
                    //url地址
                    $urlEdit = Yii::$app->urlManager->createUrl('/admin/user/update?id='.$model->id);
                    $btnEdit = $model->status != 'editable' ?
                        \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $urlEdit, ['title' => '编辑'] ) : '';


                    $urlAuth = \yii\helpers\Url::to(['rbac/assign_ment_edit', 'user_id'=>$model->id]);
                    $btnAuth = Html::a(' ', $urlAuth, ['class' => 'glyphicon glyphicon-user']);


                    return $btnEdit.'&nbsp; '.$btnAuth.'&nbsp;';

                },
            ],
            'headerOptions' => ['width' => '80'],
        ],

    ]
]);

?>