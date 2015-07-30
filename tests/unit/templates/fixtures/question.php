<?php

use app\models\Game;

$game = array_column(Game::find()->select(['id'])->asArray()->all(), 'id');

return [
    'type' => $faker->randomElement($array = ['audio', 'photo', 'group', 'video']),
    'url' => $faker->url,
    'content_name' => $faker->word,
    'game_id' => $faker->randomElement($game),
    'has_been_played' => 0,

];