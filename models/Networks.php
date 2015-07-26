<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "networks".
 *
 * @property integer $id
 * @property string $name
 * @property string $src
 */
class Networks extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'networks';
    }

    public function rules()
    {
        return [
            [['name', 'src'], 'required'],
            [['name', 'src'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'src' => 'Src',
        ];
    }

	public function getUsers()
	{
		return $this->hasMany(Users::className(),['id' => 'user_id'])
				->viaTable('user_networks', ['network_id' => 'id']);
	}
    /**
     * @inheritdoc
     * @return NetworksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NetworksQuery(get_called_class());
    }
}
