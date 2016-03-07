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
    const SCENARIO_SIGN_IN = 'enter';
    const SCENARIO_SIGN_UP = 'create';

    public $password;

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
     * Dummy functions for interfaces functions what will be not implemented in that app
     * @return null
     */
    public static function dummy(){
        return null;
    }

    /**
     * Method implemented like @dummy functions for interface
     * @param int|string $id
     * @return null
     */
    public static function findIdentity($id){
        return self::dummy();
    }

    /**
     * Method implemented like @dummy functions for interface
     * @param string $token
     * @param null $type
     * @return null
     */
    public static function findIdentityByAccessToken($token, $type = null){
        return self::dummy();
    }

    /**
     * Method implemented like @dummy functions for interface
     * @return null
     */
    public function getId(){
        return self::dummy();
    }

    /**
     * Method implemented like @dummy functions for interface
     * @return null
     */
    public function getAuthKey(){
        return self::dummy();
    }

    /**
     * Method implemented like @dummy functions for interface
     * @param string $authKey
     * @return null
     */
    public function validateAuthKey($authKey){
        return self::dummy();
    }

}

    /**
     * @inheritdoc
     */
    /*public function rules()
    {
        return [
            [['email', 'password'], 'filter', 'filter' => 'trim'],
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 8, 'max' => 24],
            ['password', 'required', 'on' => 'create'],
            ['email', 'unique', 'message' => 'This email has already been used.'],
            ['secret_key', 'unique'],
            // установить в "from" и "to" дату 3 дня и 6 дней от сегодняшней, если они пустые
            /* [['from', 'to'], 'default', 'value' => function ($model, $attribute) {
                return date('Y-m-d', strtotime($attribute === 'to' ? '+3 days' : '+6 days'));
            }], */
            /*['phone', 'filter', 'filter' => function ($value) {
                // нормализация значения происходит тут
                return $value;
            }],*//*
        ];
    }*/


    /**
     * @inheritdoc

    /*public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['username', 'password', '!secret'],
     * $model->secret = $secret;
            self::SCENARIO_SIGN_IN => ['email', 'password'],
            self::SCENARIO_SIGN_UP => ['email', 'password'],
        ];
    }*/

    /**
     * It generates a hash of the password what had sent.
     * Function call by planet17\ssu\models\Auth\Forms\Up
     *
     * @param $password
     *//*
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    /**
     * @inheritdoc
     *//*
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     *//*
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new HttpException(501, 'Identity by Token is not implemented');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     *//*
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     *//*
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     *//*
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     *//*
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     *//*
    public function validatePassword($password)
    {
        return $this->password === $password;
    }/* */ /*
}
// $this->save();
/*$model = new \app\models\ContactForm;
$model->attributes = \Yii::$app->request->post('ContactForm');*/

/*
 * public function fields()
{
    $fields = parent::fields();

    // удаляем поля, содержащие конфиденциальную информацию
    unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);

    return $fields;
}
 */