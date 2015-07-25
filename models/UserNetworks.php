<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_networks".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $network_id
 * @property string $token
 */
class UserNetworks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_networks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'network_id'], 'integer'],
            [['token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'network_id' => 'Network ID',
            'token' => 'Token',
        ];
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
