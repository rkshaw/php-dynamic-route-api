<?php

return [
    'db' => [
        'dsn' => 'mysql:host=127.0.0.1;dbname=product_db;charset=utf8mb4',
        'user' => 'root',
        'pass' => ''
    ],
    'jwt' => [
        'secret' => 'CHANGE_THIS_SECRET',
        'algo' => 'HS256',
        'ttl' => 3600
    ]
];
