<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

foreach ($dataProvider as $news)
{
	echo DetailView::widget([
		'model' => $news,
		'attributes' => [
			'title',
			'content',
			'date'
		],
	]);
}