<?php

namespace app\models;

use Lcobucci\JWT\Token;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $phone
 * @property string $access_token
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property int $status
 * @property int $site_code
 * @property int $country_id
 * @property string $timezone
 * @property string $blocked_at
 * @property string $registration_ip
 * @property string $confirmed_at
 * @property int $confirmed
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Countries $country
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username','password_hash', 'auth_key'], 'required'],
            [['status','country_id', 'site_code'], 'integer'],
            [['blocked_at', 'access_token', 'confirmed_at', 'created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 150],
            [['email'], 'unique'],
            [['username', 'password_hash', 'auth_key', 'password_reset_token', 'timezone', 'registration_ip'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'unique'],
            [['confirmed'], 'boolean'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Username',
            'phone' => 'Phone',
            'access_token'=>'Access Token',
            'site_code'=>'Site Code',
            'password_hash' => 'Password',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'country_id' => 'Country',
            'timezone' => 'Timezone',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'confirmed_at' => 'Confirmed At',
            'confirmed' => 'Confirmed',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function generateRandomPassword($length = 6) {
        $characters = 'abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            .'0123456789!@#$%^&*()';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }


    public static function setData(ClientInterface $client)
    {
        $attributes = $client->getUserAttributes();
        $data = [];
        if ($client->getId()== 'facebook'){
            $data['email']= ArrayHelper::getValue($attributes, 'email');
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['username']= ArrayHelper::getValue($attributes, 'name');;

        } elseif ($client->getId()== 'twitter'){
            $data['email']= ArrayHelper::getValue($attributes, 'email');
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['first_name']= ArrayHelper::getValue($attributes, 'first_name');
            $data['last_name']= ArrayHelper::getValue($attributes, 'last_name');
            $data['username']= $data['first_name'];

        }elseif ($client->getId() == 'google'){
            $data['email'] = $attributes['emails'][0]['value'];
            $data['id']= ArrayHelper::getValue($attributes, 'id');
            $data['last_name'] = !empty($attributes['name']['familyName']) ? $attributes['name']['familyName'] : null;
            $data['first_name'] = !empty($attributes['name']['givenName']) ? $attributes['name']['givenName'] : null;
            $data['username']= $data['first_name'];
        }

        return $data;
    }

    public static function generateToken($id)
    {
        //generate jwt access_token
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();

//        $token = $jwt->getBuilder()
//            ->setIssuer('http://example.com')// Configures the issuer (iss claim)
//            ->setAudience('http://example.org')// Configures the audience (aud claim)
//            ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
//            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
//            ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
//            ->set('uid', 100)// Configures a new claim, called "uid"
//            ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
//            ->getToken(); // Retrieves the generated token

//         Adoption for lcobucci/jwt ^4.0 version
        $token = $jwt->getBuilder()
            ->issuedBy('https://doctorateessays.com')// Configures the issuer (iss claim)
            ->identifiedBy('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->expiresAt($time + 3600)// Configures the expiration time of the token (exp claim)
            ->withClaim('uid', $id)// Configures a new claim, called "uid"
            ->getToken($signer, $key); // Retrieves the generated token
        return $token;
    }

    public static function getSiteName(){
        $user = User::findOne(Yii::$app->user->id);
        $siteCode = $user->site_code;
        if ($siteCode == 1){
            $name = '<strong style="color: #5bc0de; font-size: 20px; border-color: #71D8EC;">Verified</strong><strong style="color: #3D715B; font-size: 20px;">Professors</strong>';
        }else{
            $name = '<strong style="font-size: 20px;"></strong>';
        }
        return $name;

    }

    public static function getSiteLogo(){
        $user = User::findOne(Yii::$app->user->id);
        $siteCode = $user->site_code;
        if ($siteCode == 1){
            $logo = 'images/logo.png';
        }else{
            $logo = 'images/logo2.png';
        }
        return $logo;

    }
//    /**
//     * @inheritdoc
//     */
//    public static function findIdentityByAccessToken($token, $type = null)
//    {
//        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
//    }

    public static function getUserAssignment($user_id)
    {
        $q="SELECT user_id from auth_assignment where user_id=".$user_id."";
        $result = Yii::$app->db->createCommand($q)->queryScalar();
        return $result;
    }

    public static function getAllUsers(){
        $q="SELECT * from user";
        $result = Yii::$app->db->createCommand($q)->queryScalar();
        return $result;
    }

    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function ValidatePass($password, $password_hash)
    {
        return Yii::$app->security->validatePassword($password, $password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        try {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        try {
            $this->auth_key = Yii::$app->security->generateRandomString();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
