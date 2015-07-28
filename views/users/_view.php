<?php
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