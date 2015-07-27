<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

foreach ($networks as $network)
{
	echo Html::a($network->name,['site/index']);
}

echo $this->render('_view', [
	'dataProvider' => $dataProvider,
]);