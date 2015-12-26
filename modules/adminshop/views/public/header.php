<?php
use yii\helpers\Url;
?>
<div class="wrapper header" >

    <div class="wrapper" style="padding: 5px;">

        <?=
        yii\widgets\Breadcrumbs::widget([
            'homeLink' => [
                'url'=>Url::toRoute('index/main'),
                'label' => '起始页'
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

    </div>

</div>