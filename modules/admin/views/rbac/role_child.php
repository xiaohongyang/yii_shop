<?php

    use yii\helpers\Html;


?>

<?php

    echo \yii\widgets\Breadcrumbs::widget([
        'homeLink' => [
            'label' => '返回',
            'url' => 'javascript:history.back()'
        ],

        'links' => [
            [
                'label' => $name.'节点管理'
            ]
        ]

    ]);

?>


<div class="p20">

    <table class="table border  ">
        <thead>
        <th>id</th>
        <th>字节点名称</th>
        <th>字节点说明</th>
        <th>字节点类别</th>
        <th>操作</th>
        </thead>

        <?php
        foreach( $childList as $_k => $child ):
            ?>
            <tr>
                <td><?=$_k?></td>
                <td><?=$child->name?></td>
                <td><?=$child->description?></td>
                <td><?=$child->type==2?'许可':'节点'?></td>

                <td>

                    <?=Html::a(' ', [\yii\helpers\Url::to('rbac/role_child_delete'),'parent'=>urlencode($name),'child'=>urlencode($child->name)],
                        ['class' => 'glyphicon glyphicon-trash '.CONST_EVENT_DELETE_CONFIRM,'title' => t('app', 'delete')]) ?>

                    <?php

                        if (count($child->data)) {

                            $url = \yii\helpers\Url::to(['rbac/role_child', 'name'=>$child->name], 'http');
                            echo Html::a('子节点',$url, ['class'=>'btn btn-primary']);
                        }
                    ?>


                </td>
            </tr>

        <?php
        endforeach;
        ?>
    </table>


    <h3 >添加子节点</h3>

    <?php
        $form = \yii\bootstrap\ActiveForm::begin([
        ]);
    ?>

            <?=$form->field($model, 'parent')->textInput(['value' => $name, 'readonly' => 'readonly'])?>

            <?=$form->field($model, 'child')->textInput(['placeholder' => '请输入子节点name']) ?>

        <?=Html::activeRadioList($model, 'childType', [1 => '角色', 2 => '许可'], [
            'item' => function ($index, $label, $name, $checked, $value) {
                if($value==1)
                    $checked = true;
                return '<label class="radio-inline">' . Html::radio($name, $checked, ['value'  => $value]) . $label . '</label>';
            }
        ])?>

            <?=Html::submitButton(t('app','create'), ['class'=>'btn btn-primary']) ?>
    <?php
        $form->end();
    ?>

</div>