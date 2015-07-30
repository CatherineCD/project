<?php

namespace app\controllers;

use app\models\Question;
use yii\web\HttpException;

class QuestionController extends \yii\web\Controller
{
    public function actionView($id)
    {
        $question = Question::findOne($id);
        if (!$question)
        {
            throw new HttpException(404, "Question not found");
        }
        $answers = $question->getAnswers();

        return $this->render('view', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }

}
