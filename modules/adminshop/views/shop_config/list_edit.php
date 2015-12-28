<?php
/**
 *
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/31
 * Time: 16:19
 */

use app\widgets\AjaxFileUploadWidget;
use app\widgets\Shop_config_editWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '商店设置';
$this->params[breadcrumbs][] = $this->title;

?>



<div class="list_edit">




        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
        <?php
            foreach ($viewBag['group_list'] as $_k=>$group):
                if($_k == 1): ?>
                    <li role="presentation" class="active"><a href="#group<?=$_k?>" aria-controls="home" role="tab" data-toggle="tab"><?=$group['name']?></a></li>
        <?php   else: ?>
                    <li role="presentation"><a href="#group<?=$_k?>" aria-controls="profile" role="tab" data-toggle="tab"><?=$group['name']?></a></li>
        <?php   endif;
            endforeach
        ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content ">
            <?php
                foreach ($viewBag['group_list'] as $_k=>$group) {
            ?>
                    <div role="tabpanel" class="tab-pane  <?= $_k == 1 ? 'active' : '' ?>" id="group<?= $_k ?>">
                        网店信息<?= $_k ?>
                        <?=Shop_config_editWidget::widget(['group'=> $group]);
                        ?>
                    </div>
                <?php
                }
            ?>
        </div>

        <?=Html::submitButton(" 提交 ", ['class' => 'btn btn-success center-block' ]);  ?>



</div>



<script type="text/javascript">
    <?php
        echo AjaxFileUploadWidget::widget(['objClass'=>'.ajax_upload']);
    ?>

</script>

