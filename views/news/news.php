<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

echo Html::beginForm(['news/network-news'], 'get');
foreach ($networks as $network)
{
	echo ' '.Html::checkbox('id[]', false, ['value' =>$network->id ,'label' => $network->name]);

}
echo Html::submitButton('Sort', ['class' => 'submit']);
echo Html::resetButton('Reset', ['class' => 'reset']);

echo Html::endForm();



echo $this->render('_view', [
	'dataProvider' => $dataProvider,
]);