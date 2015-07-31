<?php
use yii\helpers\Html;

	echo "result save";

	echo "<br>";
	echo "<br>";
	echo "<br>";

	if ($isRightAnswer){
		echo "Selected answer is correct. It was ".$isRightAnswer;

	}
	else{
		echo "You gave not correct answer. Correct answer was ";
		foreach($getRightAnswer as $answer){
			echo $answer->name.', ';
		}
	}

	echo "<br>";
	echo "<br>";
	echo "<br>";

	if ($nextQuestionId === NULL){
		echo "No more questions. Game is over";
	}else {
		echo Html::beginForm(['question/view', 'id' => $nextQuestionId], 'get');
		echo Html::submitButton('Next question', ['class' => 'submit']);
		echo Html::endForm();
	}