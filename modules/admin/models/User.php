<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/6/11
 * Time: 16:32
 */

namespace app\modules\admin\models;


use yii\base\Event;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\captcha\CaptchaValidator;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface{

    const DELETE_EFFOR_INFO = 'delete_error_info';

    const EVENT_AFTER_LOGIN = 'after_login';

    public $old_password;
    public $new_password;
    public $repeat_password;

    public $captcha;

    public function init()
    {
        parent::init();


        //绑定登录后事件
        $this->on(self::EVENT_AFTER_LOGIN, [$this, 'afterLogin']);
    }

    //定义规则
    public function rules()
    {
        return [
            [['username'], 'required' , 'on' => 'login'],
            [['password'], 'required' , 'on' => 'login'],
            [['captcha'], 'required', 'on' => 'login'],
            [['captcha'], 'captcha', 'on' => 'login'],

            [['old_password', 'new_password', 'repeat_password'], 'required', 'on'=>'changePwd'],
            ['old_password','findPassword','on'=>'changePwd'],
            ['repeat_password','compare','compareAttribute'=>'new_password','on'=>'changePwd'],

            [['username', 'group'], 'required', 'on' => 'update'],
            ['password', 'safe' , 'on' => 'update'],

            [['username', 'password'], 'required' , 'on' => 'create'],
            ['username', 'findUsername', 'on' => 'create']
        ];
    }

    public function scenarios()
    {
        return [
            //登录
            'login' => ['username', 'password', 'captcha'],
            //修改密码
            'changePwd' => ['old_password', 'new_password', 'repeat_password'],
            //更新用户
            'update' => ['username', 'password', 'group'],
            //创建用户
            'create' => ['username', 'password'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'username'  =>  \Yii::t('app','username'),
            'password'  =>  '密码',
            'captcha' => '验证码',

            'old_password' =>  \Yii::t('app','old_password'),
            'new_password' =>  \Yii::t('app','new_password'),
            'repeat_password' => \Yii::t('app','repeat_password'),

        ];
    }

    /**
     * 设置事件 1>更新时间戳字段
     *
     * @return array
     */
    public function behaviors()
    {
        return [
          [
              'class' => TimestampBehavior::className(),
          ]
        ];
    }

    /**
     * 添加数据前,1>设置auth_key 2>加密密码
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \yii::$app->getSecurity()->generateRandomString();
                $this->password = $this->_md5_password($this->password, $this->auth_key);
            } else {
                if ($this->password != $this->getOldAttribute('password')) {

                    if ( strlen($this->password) && strlen($this->auth_key)) {
                        $this->password = $this->_md5_password($this->password, $this->auth_key);
                    } else if ($this->password == "") {
                        $this->password = $this->getOldAttribute('password');
                    }
                }
            }

            return true;
        }
        return false;

    }


    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.

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
        // TODO: Implement findIdentityByAccessToken() method.
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
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
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
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
        // TODO: Implement validateAuthKey() method.
        return $this->getAuthKey() === $authKey;
    }


    /**
     * 通过用户名搜索用户
     *
     * @param $username
     * @return null|static
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    /**
     * 验证密码
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {

        return $this->getAttribute('password') === $this->_md5_password($password, $this->getAttribute('auth_key'));
    }


    /**
     * 用户密码加密
     *
     * @param $password
     * @param $auth_key
     * @return string
     */
    protected function _md5_password($password,$auth_key)
    {
        return md5(md5($password).$auth_key);
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
            if (($user = $this->findByUsername($this->username)) !== null) {
                if ($user->validatePassword($this->password)) {


                    $user->trigger(self::EVENT_AFTER_LOGIN);
                    return true;
                } else {
                    $this->addError('password', '用户或密码错误!');
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

        $identity = $this->findIdentity($user->getAttribute('id'));
        \Yii::$app->user->login($identity);

    }

    /**
     * 用户登出 1>删除用户session
     *
     * @return bool
     */
    public function logout()
    {

        \Yii::$app->user->logout();

    }


    /**
     * 验证密码是否正确(在rules规则定义中调用)
     *
     * @param $attribute
     * @param $params
     */
    public function findPassword($attribute, $params)
    {
        $user = \Yii::$app->user->getIdentity();
        if ($user['password'] != $this->_md5_password($this->old_password, $user['auth_key'])) {
            $this->addError($attribute, '旧密码错误!');
        }
    }


    public function findUsername($attribute, $params)
    {
        $data = User::findOne(['username'=>$this->username]);
        if ($data) {
            $this->addError($attribute, '用户名已经存在!');
        }
    }


    /**
     * 修改并保存登录用户新密码
     *
     * @param $params
     * @return bool
     */
    public function savePassword($params)
    {

        $model = $this->findOne(['id'=>\Yii::$app->user->id]);

        if ($params && $params[$this->formName()] && count($params[$this->formName()])) {

            $model->scenario = 'changePwd';
            if ($model->load($params) && $model->validate()) {

                $model->password = $model->new_password;
                $model->save();
            }
        }
        return $model;
    }


    /**
     * 更新一个用户的信息
     *
     * @param $id
     * @param $params
     * @return bool
     */
    public function updateOne($id, $params)
    {

        $model = User::findOne($id);
        $model->scenario = 'update';

        if ($model->load($params) && $model->validate()) {

            return $model->save();
        }
        return false;
    }


    /**
     * 删除一个用户
     *
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function deleteOne($id)
    {
        if (is_numeric($id) && $this->findOne($id)->delete()) {
            return true;
        } else {
            $this->addError(static::DELETE_EFFOR_INFO, '删除失败,参数有误!');
            return false;
        }
    }


    /**
     * 添加一个用户
     *
     * @param $data
     * @return bool
     */
    public function addOne($data)
    {

        $this->scenario = 'create';
        if ($this->load($data) && $this->validate()) {
            return $this->save();
        } else {
            return false;
        }


    }

    public function  captcha()
    {

        $captcha = $this->captcha;

        $captchValidator = new CaptchaValidator();
        $captchValidator->captchaAction = '/admin/public/captcha';

        if (!$captchValidator->validate($captcha)) {
            $this->addError('captcha', '验证码错误!');
        }
    }

}