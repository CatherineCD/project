<?php
/* @var $this yii\web\View */
/* @var $question app\models\Question */
use yii\helpers\Html;
?>
<h1>Questions</h1>

<?php

echo Html::tag('p', 'Who is in the group: '.$question->content_name);

echo Html::beginForm(['question/update', 'id' => $question->id], 'post');
	foreach($answers as $answer)
	{
		echo Html::tag('p', Html::radio('answer', true, ['value' => $answer->id, 'label' => $answer->name]));
	}
	echo Html::submitButton('Reply', ['class' => 'submit']);
echo Html::endForm(); ?>