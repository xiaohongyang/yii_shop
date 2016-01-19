<?php

use app\modules\adminshop\models\User_rank;
use app\modules\adminshop\models\Users;
use yii\data\ActiveDataProvider;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;


$this->title = "会员列表";
$this->params['breadcrumbs'][] = $this->title;



foreach($userList['rankList'] as $rank){
        //p($rank);
    }


    $arr = ArrayHelper::toArray($userList['rankList']);
    //p($arr);

?>

<div class="portlet p10">

    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-cog"></i> <?=$this->title?>
        </div>
    </div>


    <div class="body">

        <?php

        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
        ?>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
            ])
        ?>

        <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => SerialColumn::className()],
                    'user_id' ,
                    'user_name',
                    'email',
                    'is_validated',
                    'user_money',
                    'frozen_money',
                    'rank_points',
                    'pay_points',
                    'reg_time',

                    [
                        'class' => DataColumn::className(),
                        'attribute' => 'is_validated',
                        'label' => '是否验证',
                        'value' => function($model){
                            return $this->render('view.php', ['model'=>$model, 'field' => 'is_validated']);
                        }
                    ]
                ]
            ]);
        ?>

    </div>

</div>