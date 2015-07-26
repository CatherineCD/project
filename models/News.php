<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property integer $user_networks_id
 * @property integer $original_id
 */
class News extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['title', 'content', 'date', 'user_networks_id', 'original_id'], 'required'],
            [['date'], 'safe'],
            [['user_networks_id', 'original_id'], 'integer'],
            [['title', 'content'], 'string', 'max' => 255]
        ];
    }

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
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}
