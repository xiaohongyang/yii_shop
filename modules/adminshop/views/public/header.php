<?php
use yii\helpers\Url;
?>
<!--<div class="wrapper header" >

    <div class="wrapper" style="padding: 5px;">

        <?/*=
        yii\widgets\Breadcrumbs::widget([
            'homeLink' => [
                'url'=>Url::toRoute('index/main'),
                'label' => '起始页'
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */?>

    </div>

</div>-->

<!-- BEGIN PAGE HEADER-->
<div class="page-bar">

    <?=yii\widgets\Breadcrumbs::widget([

            'homeLink' => [
                'url'=>Url::toRoute('index/main'),
                'label' => '起始页',
                'template' => '<li> <i class="fa fa-home"></i>
                                {link} <i class="fa fa-angle-right"></i> </li>',
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => array('class' => 'page-breadcrumb'),
            'itemTemplate' => "{link} <i class=\"fa fa-angle-right\"></i>\n", // template for all links/
        ]) ?>


    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true" aria-expanded="false">
                Actions <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">Action</a>
                </li>
                <li>
                    <a href="#">Another action</a>
                </li>
                <li>
                    <a href="#">Something else here</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="#">Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>