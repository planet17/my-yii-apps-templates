<?php
/** User: planet17 Date: 06.03.16 Time: 23:24 */
namespace planet17\ssu\models\Auth\Models;

use yii\db\ActiveRecord;
use yii\web\HttpException;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property      integer       $id
 * @property      string        $email
 * @property      string        $password_hash
 * @property      string        $auth_key
 * @property      integer       $created_at
 * @property      integer       $updated_at
 * @property      string        $secret_key
 */

class User extends ActiveRecord implements IdentityInterface
{

    const SCENARIO_SIGN_IN = 'default';
    const SCENARIO_SIGN_UP = 'create';
    const VALIDATE_ERROR_AT_LENGTH = "Trying to set value by another methods!";


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ['email' => 'E-mail', 'password' => 'Password'];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SIGN_IN => ['email', 'password_hash', 'updated_at', 'auth_key'],
            self::SCENARIO_SIGN_UP => ['email', 'password_hash', 'updated_at', 'created_at', 'auth_key']
        ];
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            [['email', 'password', 'auth_key'], 'required',
                'message' => 'Something wrong with {attribute}.',
                'skipOnEmpty' => false
            ],
            ['email', 'string', 'length' => [6, 32],
                "tooLong"    => "Значение «{attribute}» должно содержать максимум {max, number} {max, plural, one{символ} few{символа} many{символов} other{символа}}."
            ],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'This email has already been used.'],
            [ 'password_hash', 'string', 'length' => [60, 60],
                "tooShort"   => self::VALIDATE_ERROR_AT_LENGTH, "tooLong" => self::VALIDATE_ERROR_AT_LENGTH
            ],
            [ 'auth_key', 'string', 'length' => [32, 32],
                "tooShort"   => self::VALIDATE_ERROR_AT_LENGTH, "tooLong" => self::VALIDATE_ERROR_AT_LENGTH
            ],
            ['updated_at', 'filter',
                'filter' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            ['created_at', 'default',
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
                'on' => self::SCENARIO_SIGN_UP ]
        ];
    }


    /**
     * Method return USER by ID
     * @param integer $id
     * @return User
     */
    public static function findIdentity($id){
        return static::findOne([
            'id' => (integer)$id
        ]);
    }


    /**
     * It generates a hash of the password what had sent.
     * Function call by planet17\ssu\models\Auth\Forms\Up
     *
     * @param string $pwd
     */
    public function setPassword($pwd)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($pwd);
    }


    /**
     * Method return ID of User
     * @return integer id
     */
    public function getId(){
        return $this->id;
    }


    /**
     * TODO: check it, if don't need, remove that
     * Method return E-mail of User
     * @return string email
     */
    public function getEmail(){
        return $this->email;
    }


    /**
     * Dummy functions for interfaces functions what will be not implemented in that app
     * Methods bellow is all call dummy function and nothing returns.
     * That's methods dummy - cause that APPLICATION don't implements a SIGN-IN, but methods still need cause Interface
     * @return null
     */
    public static function dummy(){ return null; }
    public function getAuthKey(){ return self::dummy(); }
    public function validateAuthKey($authKey){ return self::dummy(); }

    /**
     * It generates a hash random string for auth_key.
     * Function call by:
     *  planet17\ssu\models\Auth\Forms\Up
     *  planet17\ssu\models\Auth\Forms\In
     */
    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    /**
     * Not implemented cause APP did n't have REST-API
     * @inheritdoc
     * @throws HttpException
     */
    public static function findIdentityByAccessToken($token, $type = null){
        throw new HttpException(501, 'Identity by Token is not implemented');
    }
}