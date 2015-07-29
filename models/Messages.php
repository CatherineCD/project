<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property integer $user_networks_id
 * @property integer $original_id
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'date', 'user_networks_id', 'original_id'], 'required'],
            [['date'], 'safe'],
            [['user_networks_id', 'original_id'], 'integer'],
            [['title', 'content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
            'user_networks_id' => 'User Networks ID',
            'original_id' => 'Original ID',
        ];
    }

    /**
     * @inheritdoc
     * @return MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessagesQuery(get_called_class());
    }
}
