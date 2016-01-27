<?php

use app\modules\adminshop\models\User_rank;
use app\modules\adminshop\models\Users;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;



$this->title = "会员列表";
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="portlet p10">

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cog"></i> <?=$this->title?>
        </div>
    </div>


    <div class="body">


        <?$form = ActiveForm::begin([
            'method' => 'get'
        ]);
        ?>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $model,
                    'layout' => '{pager}'
                ]);
                ?>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="table-group-actions pull-right margin-top-10">


                        <?php
                            $selectedRankId = Yii::$app->request->get()[$model->formName()]['user_rank'];
                            echo Html::dropDownList($model->formName()."[user_rank]",
                                                    $selectedRankId,
                                                    ArrayHelper::merge(
                                                        ["0"=>"选择类型"]
                                                        ,ArrayHelper::map($rankList,'rank_id', 'rank_name' )
                                                    ),
                                                    ['class' => 'select2 form-control input-inline input-small input-sm table-group-action-input']
                                                    );
                        ?>
                        &nbsp;
                        <?=Html::submitButton("", ['class'=>'btn btn-sm yellow fa fa-search ','title'=>Yii::$app->params['lang']['button_search']])?>

                </div>
            </div>

        </div>
        <?php $form->end()?>

<?php


?>

        <?php
        
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $model,
                'columns' => [
                    ['class' => SerialColumn::className()],
                    ['class' => \kartik\grid\CheckboxColumn::className()],
                    'user_id' ,
                    'user_name',
                    'email',
                    [
                        'class' => CheckboxColumn::className(),
                        'class' => DataColumn::className(),
                        'attribute' => 'is_validated',
                        'format' => 'html',
                        'value' => function($model){
                            return $this->render('list_item.php', ['model'=>$model, 'action' => 'is_validated']);
                        }
                    ],
                    'user_money',
                    'frozen_money',
                    'rank_points',
                    'pay_points',
                    'reg_time',
                    [
                        'class' => DataColumn::className(),
                        'format' => 'html',
                        'attribute' => Yii::$app->params['lang']['handler'],
                        'value' => function ($model) {
                            return $this->render('list_item.php', ['model'=>$model, 'action' => 'handler']);
                        },
                    ]

                ]
                ,
            ]);
        ?>




    </div>



</div>





?>