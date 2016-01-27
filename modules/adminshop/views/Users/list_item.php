<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php
    $userId = $model->user_id;
?>

<?php
    switch($action){
        case 'handler':
?>
            <div class="btn-group">
                <a href="<?=Url::to(["edit",'id'=>$model->user_id ])?>" title="<?=Yii::$app->params['lang']['edit']?>" class="fa fa-edit" target="_blank"></a>
                <a href="<?=Url::to(["address_list"])?>" title="<?=Yii::$app->params['lang']['address_list']?>" class="fa fa-truck"></a>
                <a href="<?=Url::to(["address_list"])?>" title="<?=Yii::$app->params['lang']['view_order']?>" class="fa fa-paperclip"></a>
                <a href="<?=Url::to(["address_list"])?>" title="<?=Yii::$app->params['lang']['view_deposit']?>" class="fa fa-dollar"></a>
                <a href="<?=Url::to(["address_list"])?>" title="<?=Yii::$app->params['lang']['remove']?>" class="fa fa-times"></a>
            </div>
<?php
            break;
        case 'is_validated':
?>
            <?=$model->is_validated? '已验证' : '未验证'?>
<?php
            break;
    }
?>
