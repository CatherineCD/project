<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;

echo Html::beginForm(['messages/index'], 'get');
foreach ($networks as $network)
{
    echo ' '.Html::checkbox('id[]', false, ['value' =>$network->id ,'label' => $network->name]);

}
echo Html::submitButton('Sort', ['class' => 'submit']);
echo Html::resetButton('Reset', ['class' => 'reset']);

echo Html::endForm();



foreach ($dataProvider as $messages)
{
    echo DetailView::widget([
        'model' => $messages,
        'attributes' => [
            'title',
            'content',
            'date'
        ],
    ]);
}