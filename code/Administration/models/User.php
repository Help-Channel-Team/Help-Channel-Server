<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "helpchannel_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $ldap_username
 * @property integer $profile_id
 *
 * @property Connection[] $connections
 * @property ConnectionTracking[] $connectionTrackings
 * @property Profile $profile
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helpchannel_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'ldap_username', 'profile_id'], 'required'],
            [['profile_id'], 'integer'],
            [['username', 'password', 'ldap_username'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['ldap_username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'ldap_username' => Yii::t('app', 'Ldap Username'),
            'profile_id' => Yii::t('app', 'Profile'),
        	'auth_key' => Yii::t('app', 'Auth Key'),
        	'access_token' => Yii::t('app', 'Access Token')
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	return static::findOne($id);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	return static::findOne(['access_token' => $token]);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		return static::findOne(['username' => $username]);
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
    	return $this->auth_key === $authKey;
    }
    
    /**
     * @inheritdoc
     */
    public function generateAccessToken()
    {
    	$this->access_token = sha1($this->password.time().rand(1000, 9999));
    	return $this->access_token;
    }
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//     	return Yii::$app->security->validatePassword($password, $this->password);
		return $this->password === $password;
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
//     	$this->password = Yii::$app->security->generatePasswordHash($password);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnections()
    {
        return $this->hasMany(Connection::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnectionTrackings()
    {
        return $this->hasMany(ConnectionTracking::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public function getGroup()
    {
    	return $this->getProfile()->one()->name;
    }
    

}
