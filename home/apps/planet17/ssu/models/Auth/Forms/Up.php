<?php
/** Date: 02.05.2015 Time: 18:17 */
namespace planet17\ssu\models\Auth\Forms;

use planet17\ssu\models\Auth\Models\User;
use yii\base\Model;
use Yii;

/**
 * This is the model class for form "sign-up".
 *
 * @property      string        $email
 * @property      string        $password
 */

class Up extends Model
{
    const SCENARIO_AJAX = 'ajax';

    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [ self::SCENARIO_AJAX => ['email']]);
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            [['email', 'password'], 'required', 'message' => 'You can\'t leave this empty.'],
            ['password', 'string', 'length' => [8, 24],
                "tooShort"   => "Значение «{attribute}» должно содержать минимум {min, number} {min, plural, one{символ} few{символа} many{символов} other{символа}}.",
                "tooLong"    => "Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}."
            ],
            ['email', 'string', 'length' => [6, 32],
                "tooLong"    => "Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}."
            ],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'This email has already been used.'
            ],
        ];
    }


    public function attributeLabels()
    {
        return ['email' => 'E-mail', 'password' => 'Password'];
    }

    /**
     * Create a new User
     * If the creation is successful then return User
     * Else return an array with error (Can use that for debug)
     *
     * @return User|array
     */
    public function signUp()
    {
        $model = new User(['scenario' => User::SCENARIO_SIGN_UP]);
        $model->email = $this->email;
        $model->setPassword($this->password);
        $model->generateAuthKey();
        return ($model->validate() && $model->save()) ? $model : $model->errors;
    }
}