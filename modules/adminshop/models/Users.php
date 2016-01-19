<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/1/19
 * Time: 5:37
 */

namespace app\modules\adminshop\models;


use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class Users extends BaseActiveRecord{


    //    user_id mediumint 会员资料自增id
//    email varchar 会员邮箱
//    user_name varchar 用户名
//    password varchar 用户密码
//    question varchar 安全问题答案
//    answer varchar 安全问题
//    sex tinyint 性别，0，保密；1，男；2，女
//    birthday date 生日日期
//    user_money decimal 用户现有资金
//    frozen_money decimal 用户冻结资金
//    pay_points int 消费积分
//    rank_points int 会员等级积分
//    address_id mediumint 收货信息id，取值表 ecs_user_address
//    reg_time int 注册时间
//    last_login int 最后一次登录时间
//    last_time datetime 应该是最后一次修改信息时间，该表信息从其他表同步过来考虑
//    last_ip varchar 最后一次登录ip
//    visit_count smallint 登录次数
//    user_rank tinyint 会员登记id，取值ecs_user_rank
//    is_special tinyint
//    salt varchar
//    parent_id mediumint 推荐人会员id，
//    flag tinyint
//    alias varchar 昵称
//    msn varchar msn
//    qq varchar qq号
//    office_phone varchar 办公电话
//    home_phone varchar 家庭电话
//    mobile_phone varchar 手机
//    is_validated tinyint
//    credit_line decimal 信用额度，目前2.6.0版好像没有作实现

    public function GetList($params=[]){


        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' =>  8
            ]
        ]);


        return $dataProvider;
    }

    public  function getTest(){
        return 321;
    }

}