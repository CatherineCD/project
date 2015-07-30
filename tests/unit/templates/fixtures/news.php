<?php

use app\models\UserNetworks;

$userNetworks = array_column(UserNetworks::find()->select(['id'])->asArray()->all(), 'id');

return [
	'title' => $faker->word,
	'content' => $faker->realText($maxNbChars = 50, $indexSize = 2),
	'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
	'user_networks_id' => (int)$faker->randomElement($userNetworks),
	'original_id' => $faker->randomNumber($nbDigits = NULL),
];