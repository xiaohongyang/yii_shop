<?php
use yii\helpers\Html;
?>

<?php

    if($field == 'is_validated'){
        echo $model->$field==true ? '已验证' : '未验证';
    }else{
        echo Html::encode($model->$fields);
    }

?>