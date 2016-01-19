<?php
use yii\helpers\Html;
use app\assets\admin\ToFrameAsset;

//    ToFrameAsset::register($this);
?>


<div class="header">

    <div class="dl-title">
        <a href="http://sc.chinaz.com" title="文档库地址" target="_blank">
            <span class="lp-title-port"> </span><span class="dl-title-text"><?= Yii::getAlias('@webName') ?></span>
        </a>
    </div>

    <div class="dl-log">欢迎您，
        <span class="dl-log-user"><?= \Yii::$app->shop_admin_user->identity->user_name ?></span><a
            href="<?= Yii::$app->urlManager->createUrl('/adminshop/public/logout') ?>" title="退出系统"
            class="dl-log-quit">[退出]</a><a
            href="<?= Yii::$app->urlManager->createUrl('/adminshop/public/logout') ?>" title="文档库"
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
                <div class="nav-item-inner nav-begin">起始页</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-navigation">设置导航栏</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-goodslist">商品列表</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-orderlist">订单列表</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-comment">用户评论</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-userlist">会员列表</div>
            </li>
            <li class="nav-item">
                <div class="nav-item-inner nav-shopconfig">商店设置</div>
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
                text: '起始页',
                items: [
                    {
                        selected: true,
                        id: 'main',
                        text: '起始页',
                        href: '<?=\Yii::$app->urlManager->createUrl('/adminshop/index/main')?>',
                        closeable: false
                    }
                ]
            }]
        }, {
            id: 'navigation',
            menu: [{
                text: '设置导航栏',
                items: [
                    {
                        id: 'create',
                        text: '设置导航栏',
                        href: '<?=\Yii::$app->urlManager->createUrl('/adminshop/user/create')?>'
                    },
                ]
            }]
        }, {
            id: 'rbac',
            menu: [{
                text: 'rbac权限管理',
                items: [
                    {
                        id: 'role_create',
                        text: '创建角色',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/rbac/role_create')?>'
                    },
                    {
                        id: 'role_list',
                        text: '角色/模块列表',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/rbac/role_list')?>'
                    },
                    {
                        id: 'permission_create',
                        text: '创建许可',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/rbac/permission_create')?>'
                    },
                    {
                        id: 'permission_list',
                        text: '许可列表',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/rbac/permission_list')?>'
                    },
                ]
            }]
        }, {
            id: 'category',
            menu: [{
                text: '类别管理',
                items: [
                    {
                        id: 'create',
                        text: '创建类别',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/category/create')?>'
                    },
                    {
                        id: 'categories',
                        text: '类别列表',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/category/index')?>'
                    },
                ]
            }]
        }, {
            id: 'comment',
            menu: [{
                text: '用户评论',
                items: [
                    {
                        id: 'articles',
                        text: '用户评论',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/article/articles')?>'
                    },
                ]
            }]
        }, {
            id: 'userlist',
            menu: [{
                text: '会员列表',
                items: [
                    {
                        id: 'userlist',
                        text: '会员列表',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/users/list')?>'
                    },
                ]
            }]
        }, {
            id: 'shopconfig',
            menu: [{
                text: '商店设置',
                items: [
                    {
                        id: 'articles',
                        text: '商店设置',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/shop_config/list_edit')?>'
                    },
                ]
            }]
        }, {
            id: 'article',
            menu: [{
                text: '文章管理',
                items: [
                    {
                        id: 'articles',
                        text: '文章列表',
                        href: '<?=Yii::$app->urlManager->createUrl('/adminshop/article/articles')?>'
                    },
                ]
            }]
        },

        ];
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>