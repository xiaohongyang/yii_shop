<?php

    $nomal = [
        'Already exist' => '已经存在!',
        'allready' => '已经',
        'admin' => '管理',
        'be' => '为',
        'create'   => '创建',
        'child' => '子',
        'node' => '节点',
        'delete' => '删除',
        'data' => '数据',
        "does not" => '不',
        'edit'     => '编辑',
        'exists' => '存在',
        'fail' => '失败',
        'can\'t' => '不能',
        'Hello' => '您好',
        'null' => '空',
        'not' => '不',
        'permission' => '许可',
        'role' => '角色',
        'success' => '成功',
        'user' => '用户',
        'update' => '更新',
        'update success' => '更新成功!'
    ];

    $field = [

        'username'  =>  '用户名',
        'password'  =>  '密码',

        'old_password'  =>  '原密码',
        'new_password'  =>  '新密码'
        ,'repeat_password' => '重复密码'

        ,'filed_rank_name' => '会员等级名称'

    ];

    $label = [

        //共用label
        'label_captcha' => '验证码',


        //管理员用户表ecs_admin_user
        'label_user_name' => '用户名',
        'label_password' => '密码',

    ];

    return array_merge($nomal, $field, $label);
?>