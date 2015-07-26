<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Registration</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'password_repeat')->passwordInput() ?>

<?= Html::submitButton('Registration') ?>

<?php ActiveForm::end(); ?>
