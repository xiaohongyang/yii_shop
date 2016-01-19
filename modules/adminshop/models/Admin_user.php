<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/7/30
 * Time: 15:00
 */
namespace app\modules\adminshop\models;

use yii\behaviors\TimestampBehavior;
use yii\captcha\CaptchaValidator;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Admin_user extends ActiveRecord implements IdentityInterface{

    const SCENARIO_LOGIN = 'login';

    const EVENT_AFTER_LOGIN = 'after_login';

    public $captcha;

    public $old_password;
    public $new_password;
    public $repeat_password;

    public $identityClass = 'app\modules\adminshop\models\Admin_user';


    public function init()
    {

        parent::init();


        //绑定登录后事件
        $this->on(self::EVENT_AFTER_LOGIN, [$this, 'afterLogin']);
    }

    public static function tableName()
    {
        return \Yii::$app->db->tablePrefix.'Admin_user';
    }


    public function rules()
    {
        return [
            [
                ['user_name', 'password', 'captcha'],'required', 'on' => self::SCENARIO_LOGIN,
            ],
            [

                ['captcha'],'captcha', 'on' => self::SCENARIO_LOGIN,
            ]

        ];
    }
    public function attributeLabels()
    {
        return [
            'user_name' => t('label_user_name'),
            'password' => t('label_password'),
            'captcha' => t('label_captcha'),
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['user_name', 'password', 'captcha'],
        ];
    }



    /***********IdentityInterface Begin*************/

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * Returns a key that can be used to check the valuser_idity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->ec_salt;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /***********IdentityInterface End*************/



    /**
     * 通过用户名搜索用户
     *
     * @param $user_name
     * @return null|static
     */
    public static function findByuser_name($user_name)
    {
        return static::findOne(['user_name'=>$user_name]);
    }

    /**
     * 验证密码
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {

        return $this->getAttribute('password') === $this->_md5_password($password, $this->getAttribute('ec_salt'));
    }


    /**
     * 用户密码加密
     *
     * @param $password
     * @param $ec_salt
     * @return string
     */
    protected function _md5_password($password,$ec_salt)
    {
//        return md5(md5($password).$ec_salt);

        return md5(md5($password).$ec_salt);
    }

    /**
     * 表单登录
     *
     * @param $params
     * @return bool
     */
    public function login($params)
    {
        $this->setScenario('login');
        if ($this->load($params) && $this->validate()) {
            if (($user = $this->findByuser_name($this->user_name)) !== null) {
                if ($user->validatePassword($this->password)) {


                    $user->trigger(self::EVENT_AFTER_LOGIN);
                    return true;
                } else {
                    $this->addError('password', t('users', 'login_failure'));
                }
            }
        }

        return false;
    }

    /**
     * 登录后处理 1.记录session
     *
     * @param $event
     */
    public function afterLogin($event)
    {
        $user =  $event->sender;

        $identity = $this->findIdentity($user->getAttribute('user_id'));
        \Yii::$app->shop_admin_user->login($identity);

    }

    /**
     * 用户登出 1>删除用户session
     *
     * @return bool
     */
    public function logout()
    {

       return \Yii::$app->shop_admin_user->logout();

    }

    public function  captcha()
    {

        $captcha = $this->captcha;

        $captchValidator = new CaptchaValidator();
        $captchValidator->captchaAction = '/adminshop/public/captcha';

        if (!$captchValidator->validate($captcha)) {
            $this->addError('captcha', '验证码错误!');
        }
    }

}