<?php

use app\models\Users;
use app\models\Networks;

$users = array_column(Users::find()->select(['id'])->asArray()->all(), 'id');
$networks = array_column(Networks::find()->select(['id'])->asArray()->all(), 'id');

return [
	'user_id' => (int)$faker->randomElement($users),
	'network_id' => (int)$faker->randomElement($networks),
	'token' => $faker->password,
];
