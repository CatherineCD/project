<?php
/* @var $this yii\web\View */
use yii\helpers\Html;


echo Html::a('All news',['users/news']);

echo $this->render('_view',[
	'dataProvider' => $dataProvider,
]);