<?php
use yii\helpers\Html;

echo "result save";
echo "<br>";
echo $isRightAnswer;
echo "<br>";
echo "<br>";
echo "<br>";

if ($nextQuestionId === NULL){
	echo "game is over";
}else {
	echo Html::beginForm(['question/view', 'id' => $nextQuestionId], 'get');
	echo Html::submitButton('Next question', ['class' => 'submit']);
	echo Html::endForm();
}