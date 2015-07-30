<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $type
 * @property string $url
 * @property string $content_name
 * @property integer $score
 * @property integer $game_id
 * @property integer $has_been_played
 */
class Question extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'question';
    }

    public function rules()
    {
        return [
            [['type'], 'string'],
            [['url', 'content_name', 'game_id', 'has_been_played'], 'required'],
            [['score', 'game_id', 'has_been_played'], 'integer'],
            [['url', 'content_name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'url' => 'Url',
            'content_name' => 'Content Name',
            'score' => 'Score',
            'game_id' => 'Game ID',
            'has_been_played' => "Has Been Played",
        ];
    }

	public function getAnswers()
	{
		return $this->hasMany(Answer::className(),['id' => 'answer_id'])
				->viaTable('question_answer', ['question_id' => 'id']);
	}
    /**
     * @inheritdoc
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }
}
