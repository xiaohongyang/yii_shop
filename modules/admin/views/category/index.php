<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/26
 * Time: 17:32
 */
use yii\grid\GridView;
use yii\helpers;
?>

<table class="table table-border">
    <thead>
        <th> 序号</th>
        <th> 名称</th>
        <th> 层级</th>
        <th> 排序</th>
        <th> 操作</th>
    </thead>

    <?php
        foreach($list as $_k => $row):
    ?>
        <tr>
            <td><?=$_k+1?></td>
            <td><?=$row['category_name']?></td>
            <td><?=$row['level'] ?></td>
            <td> <?=$row['ord'] ?> </td>
            <td>
                <?=helpers\Html::a(     t('app','edit'),
                                        ['category/update','id'=>$row['category_id']] ,
                                        ['class'=>'btn btn-primary btn-xs']
                                    )
                ?>
                <?=helpers\Html::a(     t('app','delete'),
                                        ['category/delete','id'=>$row['category_id']] ,
                                        ['class'=>'btn btn-primary btn-xs', 'title' => '删除']
                                    )
                ?>
            </td>
        </tr>
    <?php
        endforeach;
    ?>
</table>