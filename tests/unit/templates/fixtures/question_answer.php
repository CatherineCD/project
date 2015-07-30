<?php

use app\models\Question;
use app\models\Answer;

$question = array_column(Question::find()->select(['id'])->asArray()->all(), 'id');
$answer = array_column(Answer::find()->select(['id'])->asArray()->all(), 'id');
$boolean = [0, 1];

return [
    'question_id' => $faker->randomElement($question),
    'answer_id' => $faker-> randomElement($answer),
    'is_right' => $faker->randomElement($boolean),
];