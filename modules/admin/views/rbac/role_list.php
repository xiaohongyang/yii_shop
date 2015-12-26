<?php

use \yii\helpers\Html;
use yii\bootstrap\Modal;

?>

<?php

    echo \yii\widgets\Breadcrumbs::widget([
//        'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
        'homeLink' => [
            'label' => '管理后台',
        ],
        'links' => [

            [
                'label' => '角色/模块列表',
                'url' => ['rbac/role_list']
            ]

        ],
    ]);

?>


    <div class="p20">
        <?=Html::a('角色',\yii\helpers\Url::to(['rbac/role_list','hasparent'=>1]),['class'=>'btn btn-success']) ?>
            &nbsp;
        <?=Html::a('模块',\yii\helpers\Url::to(['rbac/role_list','hasparent'=>0]),['class'=>'btn btn-success']) ?>

        <br/>
        <br/>

        <?php

        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
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

                    'template' => "{update}  {delete} {child}",
                    'buttons' => [



                        'update' => function ($url, $model, $key) {
                            $url = \yii\helpers\Url::to(['rbac/role_update','name'=>$model->name]);
                            return Html::a(' ',$url,['class' => 'glyphicon glyphicon-pencil', 'title' => t('app','update')]);
                        },
                        'delete' => function ($url, $model, $key) {
                            $url = \yii\helpers\Url::to(['rbac/role_delete','name'=>$model->name]);
                            return Html::a(' ',$url,['class' => 'glyphicon glyphicon-trash '.CONST_EVENT_DELETE_CONFIRM, 'title' => t('app','delete')]);
                        },
                        'child' => function ($url, $model, $key) {
                            $url = \yii\helpers\Url::to(['rbac/role_child', 'name'=>$model->name], 'http');

                            return Html::button('子节点',[
                                'value'=>$url,
                                'class' => 'btn btn-success btn_show_modal',
                                'id'=>'modalButton',
                                'data-toggle' => 'modal',
                                'data-target' => '#iframeModal',
                                'title' =>  '子节点'

                                    ]);
                        }
                    ]
                ]


            ]
        ]);

        ?>

    </div>


