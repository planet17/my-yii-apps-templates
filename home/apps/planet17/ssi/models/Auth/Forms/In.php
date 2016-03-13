<?php

namespace planet17\ssi\models\Auth\Forms;

use planet17\ssi\models\Auth\Models\User;
use yii\base\Model;
use yii\web\HttpException;
use Yii;

/**
 * LoginForm is the model behind the login form.
 */
class In extends Model
{

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_BY_NAME = 'name';


    public $email;
    public $password;
    public $rememberMe = true;
    public $username;


    /**
     * Just keep \planet17\ssi\models\Auth\Models\User in the object, for not calls same method twice or more times.
     * Method ::getUser() return that object
     *
     * @var \planet17\ssi\models\Auth\Models\User|bool
     */
    private $_user = false;


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['email', 'password', 'rememberMe'],
            self::SCENARIO_BY_NAME => ['username', 'password', 'rememberMe']
        ];
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            [['email', 'password'], 'required', 'on' => self::SCENARIO_DEFAULT,
                'message' => 'You can\'t leave this empty.'],
            [['username', 'password'], 'required', 'on' => self::SCENARIO_BY_NAME,
                'message' => 'You can\'t leave this empty.'],
            ['email', 'email', 'on' => self::SCENARIO_DEFAULT],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }


    public function attributeLabels()
    {
        return ['email' => 'E-mail', 'password' => 'Password', 'rememberMe' => 'Remember me', 'username' => 'username'];
    }


    /**
     * Sign in a user using the provided password and email or username.
     * @return boolean whether the user is logged in successfully
     */
    public function signIn()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $field = ($this->scenario === self::SCENARIO_DEFAULT) ? 'email' : 'username';
                $this->addError($attribute, 'Incorrect ' . $field . ' or password.');
            }
        }
    }


    /**
     * Finds user by [[email]|[username]]
     * If _user is still false, then we get \planet17\ssi\models\Auth\Models\User for definition
     * If _user is defined then just return that user
     *
     * @return User|null
     * @throws HttpException
     */
    public function getUser()
    {
        if ($this->_user === false) {
            if($this->scenario === self::SCENARIO_BY_NAME) {
                throw new HttpException(501, 'Sign In by USERNAME is not implemented');
                // TODO $this->_user = User::findByUsername($this->username);
            } else {
                $this->_user = User::findByMail($this->email);
            }
        }

        return $this->_user;
    }
}