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
 * @property integer $answer_id
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
            [['url', 'content_name', 'game_id',], 'required'],
            [['score', 'game_id', 'answer_id'], 'integer'],
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
			'answer_id' => 'Answer ID',
        ];
    }

	public function nextQuestionId()
	{
		$query = 'game_id='.$this->game_id.' AND answer_id=0';
		$newQuestion = self::find()->where($query)->one();
		if (!$newQuestion)
		{
			return NULL;
		}
		return $newQuestion->id;

	}

	public function getAnswers()
	{
		return $this->hasMany(Answer::className(),['id' => 'answer_id'])
				->viaTable('question_answer', ['question_id' => 'id']);
	}

	public function getRightAnswer()
	{
		$query = 'question_answer.is_right=1 AND question_answer.question_id='.$this->id;
		return $this->hasMany(Answer::className(),['id' => 'answer_id'])
				->viaTable('question_answer', ['question_id' => 'id'])
				->innerJoin('question_answer', 'answer.id=question_answer.answer_id')
				->where($query);
	}

	public function isRightAnswer()
	{
		$rightAnswer = $this->getRightAnswer()->all();
		foreach($rightAnswer as $answer)
		{
			if ($answer->id == $this->answer_id){
				return $answer->name;
			}
		}
		return false;
	}

	public function selectAnswer($answer_id)
	{
		return $this->hasMany(QuestionAnswer::className(), ['question_id' => 'id'])
				->where('answer_id = :id', ['id' => $answer_id]);
	}

	public function checkAnswer($answer_id)
	{
		$this->answer_id =$answer_id;
		$QuestionAnswer = $this->selectAnswer($answer_id)->all();
		$this->score =$QuestionAnswer[0]->is_right;
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
