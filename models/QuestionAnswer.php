<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $answer_id
 * @property integer $is_right
 */
class QuestionAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'answer_id', 'is_right'], 'required'],
            [['question_id', 'answer_id', 'is_right'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'answer_id' => 'Answer ID',
            'is_right' => 'Is Right',
        ];
    }

    /**
     * @inheritdoc
     * @return QuestionAnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionAnswerQuery(get_called_class());
    }
}
