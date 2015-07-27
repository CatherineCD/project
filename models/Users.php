<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 */
class Users extends ActiveRecord implements IdentityInterface
{
	public $password_repeat;
	public $authKey;

	public function beforeSave($insert)
	{
		if(isset($this->password_repeat))
		{
			$hash = Yii::$app->getSecurity()->generatePasswordHash($this->password_repeat);
			$this->password = $hash;
		}
		return parent::beforeSave($insert);
	}

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['email', 'password', 'password_repeat'], 'required'],
	        ['email', 'email'],
	        ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['email', 'password'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

	public function  getNetworks()
	{
		return $this->hasMany(Networks::className(), ['id' => 'network_id'])
				->viaTable('user_networks', ['user_id' => 'id']);
	}

	public function getNews($networks_id = NULL)
	{
		if (!$networks_id) {
			return $this->hasMany(News::className(), ['user_networks_id' => 'id'])
					->viaTable('user_networks', ['user_id' => 'id'])
					->orderBy('date DESC');
		}else{
			return $this->hasMany(News::className(), ['user_networks_id' => 'id'])
					->viaTable('user_networks', ['user_id' => 'id'])
					->innerJoin('user_networks', 'news.user_networks_id=user_networks.id')
					->where('user_networks.network_id = :networks_id', [':networks_id' => $networks_id])
					->orderBy('date DESC');
		}
	}

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

	public static function findByUsername($email)
	{
		return static::findOne(['email' => $email]);
	}

	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token' => $token]);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->authKey;
	}

	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->password);
	}
}
