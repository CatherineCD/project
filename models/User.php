<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $vk_id
 * @property string $token
 */
class User extends ActiveRecord implements IdentityInterface
{
	public $password;
	public $authKey;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['vk_id'], 'integer'],
            [['token'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vk_id' => 'Vk ID',
            'token' => 'Token',
        ];
    }

	public function getQuestions()
	{
		return $this->hasMany(Question::className(), ['game_id' => 'id'])
				->viaTable('game', ['user_id' => 'id']);
	}

    public function getGames()
    {
        return $this->hasMany(Game::className(), ['user_id' => 'id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findOrCreateUser($vk_id)
    {
        if (!User::findByVkId($vk_id))
        {
            $model = new User();
            $model->vk_id = $vk_id;
            $model->save();

            $profile = new Profile();
            $profile->user_id = $model->id;
            $profile->save();
        }
        return User::findByVkId($vk_id);
    }

	public static function findByVkId($vk_id)
	{
		return static::findOne(['vk_id' => $vk_id]);
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
		return $this->password;
	}

	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}
}
