<?php

namespace app\controllers;

use app\models\Question;
use app\models\Answer;
use app\models\QuestionAnswer;
use yii\web\HttpException;
use yii\web\Request;
use Yii;

class QuestionController extends \yii\web\Controller
{
    public function actionView($id)
    {
        $question = Question::findOne($id);
        if (!$question) {
            throw new HttpException(404, "Question not found");
        }

        if (Yii::$app->request->isPost) {
	        $answer_id = Yii::$app->request->post('answer');
			$question->recordScore($answer_id);
	        $isRightAnswer = $question->isRightAnswer($question->id, $answer_id);
			$nextQuestionId = $question->nextQuestionId($question->game_id);

			return $this->render('proba',[
				'isRightAnswer' => $isRightAnswer,
				'nextQuestionId' => $nextQuestionId,
			]);
        }
	    if (Yii::$app->request->isGet) {
		    if ($question->has_been_played == true) {
			    throw new HttpException(404, "You have given the answer to this question");
		    }else {
			    $answers = $question->answers;

			    return $this->render('view', [
					    'question' => $question,
					    'answers' => $answers,
			    ]);
		    }
	    }
    }
}
