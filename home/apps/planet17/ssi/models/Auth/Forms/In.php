<?php

namespace planet17\ssi\models\Auth\Forms;

use planet17\ssi\models\Auth\Models\User;
use yii\base\Model;
use Yii;

/**
 * LoginForm is the model behind the login form.
 */
class In extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
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
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

//    const SCENARIO_AJAX = 'ajax';
//
//    public $email;
//    public $password;
//
//    /**
//     * @inheritdoc
//     */
//    public function scenarios()
//    {
//        return array_merge(parent::scenarios(), [ self::SCENARIO_AJAX => ['email']]);
//    }
//
//    public function rules()
//    {
//        return [
//            [['email', 'password'], 'filter', 'filter' => 'trim'],
//            [['email', 'password'], 'required', 'message' => 'You can\'t leave this empty.'],
//            ['password', 'string', 'length' => [8, 24],
//                "tooShort"   => "Значение «{attribute}» должно содержать минимум {min, number} {min, plural, one{символ} few{символа} many{символов} other{символа}}.",
//                "tooLong"    => "Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}."
//            ],
//            ['email', 'string', 'length' => [6, 32],
//                "tooLong"    => "Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}."
//            ],
//            ['email', 'email'],
//            ['email', 'unique',
//                'targetClass' => User::className(),
//                'message' => 'This email has already been used.'
//            ]
//        ];
//    }
//
//
//    public function attributeLabels()
//    {
//        return ['email' => 'E-mail', 'password' => 'Password'];
//    }
//
//    /**
//     * Create a new User
//     * If the creation is successful then return User
//     * Else return an array with error (Can use that for debug)
//     *
//     * @return User|array
//     */
//    public function signUp()
//    {
//        $model = new User(['scenario' => User::SCENARIO_SIGN_UP]);
//        $model->email = $this->email;
//        $model->setPassword($this->password);
//        $model->generateAuthKey();
//        return ($model->validate() && $model->save()) ? $model : $model->errors;
//    }
}
