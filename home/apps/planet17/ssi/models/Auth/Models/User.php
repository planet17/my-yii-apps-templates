<?php

namespace planet17\ssi\models\Auth\Models;

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
     * @inheritdoc
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
     * Dummy functions for interfaces functions what will be not implemented in that app
     * @return null
     */
    public static function dummy(array $params){
        var_dump($params);
        die('dummy');
        return null;
    }


    /**
     * Method implemented like @dummy functions for interface
     * @return null
     */
    public function getAuthKey(){
        return self::dummy(['getAuthKey']);
    }


    /**
     * Method implemented like @dummy functions for interface
     * @param string $authKey
     * @return null
     */
    public function validateAuthKey($authKey){
        return self::dummy([$authKey, 'validateAuthKey']);
    }


    /**
     * Method return ID of User
     * @return integer id
     */
    public function getId(){
        return self::dummy(['findIdentity']);
        return $this->id;
    }


    /**
     * Method return USER by ID
     * @param integer $id
     * @return User
     */
    public static function findIdentity($id){
        return self::dummy(['findIdentity']);
        return static::findOne([
            'id' => (integer)$id
        ]);
    }

    /**
     * Not implemented cause APP did n't have REST-API
     * @inheritdoc
     * @throws HttpException
     */
    public static function findIdentityByAccessToken($token, $type = null){
        throw new HttpException(501, 'Identity by Token is not implemented');
    }



    /*
     *********************
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    ********************
    /*
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    ********************
    /*
     * @inheritdoc
    public function getAuthKey()
    {
        return $this->authKey;
    }
    ********************
    /*
     * @inheritdoc
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    ********************

    /* */
}