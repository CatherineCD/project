<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>
<h1>Questions</h1>

<?php
echo Html::beginForm(['question/view', 'id' => $question->id], 'post');
	foreach($answers as $answer)
	{
		echo Html::tag('p', Html::radio('answer', true, ['value' => $answer->id, 'label' => $answer->name]));
	}
	echo Html::submitButton('Reply', ['class' => 'submit']);
echo Html::endForm(); ?>