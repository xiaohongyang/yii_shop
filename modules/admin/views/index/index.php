<?php
use yii\helpers\Html;
use app\assets\admin\ToFrameAsset;

//    ToFrameAsset::register($this);
?>


<div class="header">

    <div class="dl-title">
        <a href="http://sc.chinaz.com" title="文档库地址" target="_blank">
            <span class="lp-title-port"> </span><span class="dl-title-text"><?=Yii::getAlias('@webName')?></span>
        </a>
    </div>

    <div class="dl-log">欢迎您，
        <span class="dl-log-user"><?= \Yii::$app->user->identity->username ?></span><a
            href="<?= Yii::$app->urlManager->createUrl('/admin/public/logout') ?>" title="退出系统"
            class="dl-log-quit">[退出]</a><a
            href="<?= Yii::$app->urlManager->createUrl('/admin/public/logout') ?>" title="文档库"
            class="dl-log-quit">文档库</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform">
            <div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div>
        </div>
        <ul id="J_Nav" class="nav-list ks-clear">
            <li class="nav-item dl-selected">
                <div class="nav-item-inner nav-setup">设置修改</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-order">用户管理</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-inventory">系统管理</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-supplier">类别管理</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-marketing">文章管理</div>
            </li>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>



<?= Html::cssFile('@web/assets/css/dpl-min.css') ?>
<?= Html::cssFile('@web/assets/css/bui-min.css') ?>
<?= Html::cssFile('@web/assets/css/main-min.css') ?>
<?= Html::cssFile('@web/css/site.css') ?>
<?= Html::jsFile('@web/assets/js/jquery-1.8.1.min.js') ?>
<?= Html::jsFile('@web/assets/js/bui-min.js') ?>
<?= Html::jsFile('@web/assets/js/common/main-min.js') ?>
<?= Html::jsFile('@web/assets/js/config-min.js') ?>


<script>
    BUI.use('common/main', function () {
        var config = [{
            id: 'menu',
            menu: [{
                text: '用户信息修改',
                items: [
                    {
                        id: 'aboutuser',
                        text: '修改密码',
                        href: '<?=\Yii::$app->urlManager->createUrl('/admin/user/changepassword')?>',
                        closeable: false
                    }
                ]
            } ]
        }, {
            id: 'user',
            menu: [{
                text: '用户管理',
                items: [
                    {id: 'list', text: '用户列表', href: '<?=\Yii::$app->urlManager->createUrl('/admin/user/list')?>'},
                    {id: 'create', text: '创建用户', href: '<?=\Yii::$app->urlManager->createUrl('/admin/user/create')?>'},
                ]
            }]
        }, {
            id: 'rbac',
            menu: [{
                text: 'rbac权限管理',
                items: [
                    {id: 'role_create', text: '创建角色', href: '<?=Yii::$app->urlManager->createUrl('/admin/rbac/role_create')?>'},
                    {id: 'role_list', text: '角色/模块列表', href: '<?=Yii::$app->urlManager->createUrl('/admin/rbac/role_list')?>'},
                    {id: 'permission_create', text: '创建许可', href: '<?=Yii::$app->urlManager->createUrl('/admin/rbac/permission_create')?>'},
                    {id: 'permission_list', text: '许可列表', href: '<?=Yii::$app->urlManager->createUrl('/admin/rbac/permission_list')?>'},
                ]
            }]
        }, {
            id: 'category',
            menu: [{
                text: '类别管理',
                items: [
                    {id: 'create', text: '创建类别', href: '<?=Yii::$app->urlManager->createUrl('/admin/category/create')?>'},
                    {id: 'categories', text: '类别列表', href: '<?=Yii::$app->urlManager->createUrl('/admin/category/index')?>'},
                ]
            }]
        }, {
            id: 'article',
            menu: [{
                text: '文章管理',
                items: [
                    {id: 'articles', text: '文章列表', href: '<?=Yii::$app->urlManager->createUrl('/admin/article/articles')?>'},
                ]
            }]
        }];
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>