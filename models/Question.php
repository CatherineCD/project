<?php

namespace app\models;

use Yii;
use app\models\QuestionAnswer;

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

	public function nextQuestionId($game_id)
	{
		$query = 'game_id='.$game_id.' AND has_been_played=0';
		$newQuestion = self::find()->where($query)->all();
		return $newQuestion[0]->id;
	}

	public function getAnswers()
	{
		return $this->hasMany(Answer::className(),['id' => 'answer_id'])
				->viaTable('question_answer', ['question_id' => 'id']);
	}

	public function getRightAnswer($question_id)
	{
		$query = 'question_answer.is_right=1 AND question_answer.question_id='.$question_id;
		return $this->hasMany(Answer::className(),['id' => 'answer_id'])
				->viaTable('question_answer', ['question_id' => 'id'])
				->innerJoin('question_answer', 'answer.id=question_answer.answer_id')
				->where($query);
	}

	public function isRightAnswer($question_id, $answer_id)
	{
		$rightAnswer = $this->getRightAnswer($question_id)->all();
		$setAnswer = 'You gave the wrong answer. Correct answers is ';
		foreach($rightAnswer as $answer)
		{
			$setAnswer.=$answer->name.', ';
			if ($answer->id == $answer_id){
				return 'Selected answer is correct';
			}
		}
		return $setAnswer;
	}

	public function selectAnswer($answer_id)
	{
		return $this->hasMany(QuestionAnswer::className(), ['question_id' => 'id'])
				->where('answer_id = :id', ['id' => $answer_id]);
	}

	public function recordScore($answer_id)
	{
		$QuestionAnswer = $this->selectAnswer($answer_id)->all();
		$this->score =$QuestionAnswer[0]->is_right;
		$this->has_been_played = 1;
		$this->save();
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
