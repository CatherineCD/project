<?php

return [
    'adminEmail' => 'admin@example.com',
    'auth_url' => "https://oauth.vk.com",
    'api_url' => "https://api.vk.com/method",
    'code_request' =>
        [
            'client_id' => '5006568',
            'display' => 'popup',
            'redirect_uri' => "http://project/user/login",
            'scope' => 'friends,offline',
            'response_type' => 'code',
            'api_version' => '5.35',
        ],
    'token_request' =>
        [
            'client_id' => '5006568',
            'client_secret' => 'RTKev2vHrY4KvwkL63ZA',
            'redirect_uri' => 'http://project/user/login',
        ],
];