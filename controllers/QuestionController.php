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
	public $question;

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		$id = Yii::$app->request->get('id');
		$this->question = Question::findOne($id);
		if (!$this->question) {
			throw new HttpException(404, "Question not found");
		}

		return true; // or false to not run the action
	}

	public function actionView($id)
    {
        $question = $this->question;

		if ($question->answer_id) {
			$isRightAnswer = $question->isRightAnswer();
			$getRightAnswer = $question->getRightAnswer()->all();
			$nextQuestionId = $question->nextQuestionId();

			return $this->render('view_'. $question->type,[
				'isRightAnswer' => $isRightAnswer,
				'nextQuestionId' => $nextQuestionId,
				'getRightAnswer' => $getRightAnswer,
			]);
		}
		else {
			$answers = $question->answers;

			return $this->render('view_' . $question->type . '_form', [
					'question' => $question,
					'answers' => $answers,
			]);
		}
    }

	public function actionUpdate($id){
		$answer_id = Yii::$app->request->post('answer');
		$this->question->checkAnswer($answer_id);

		$this->redirect('/question/'.$id);
	}
}
