<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property string $started
 * @property string $finished
 * @property integer $score
 * @property integer $user_id
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['started', 'user_id'], 'required'],
            [['started', 'finished'], 'safe'],
            [['score', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'started' => 'Started',
            'finished' => 'Finished',
            'score' => 'Score',
            'user_id' => 'User ID',
        ];
    }

    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['game_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameQuery(get_called_class());
    }
}
