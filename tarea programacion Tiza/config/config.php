<?php

return [
    'mysql' => [
        'servidor' => getenv('DB_HOST') ?: '127.0.0.1',
        'puerto' => getenv('DB_PORT') ?: '3306',
        'base' => getenv('DB_DATABASE') ?: 'mi_proyecto',
        'usuario' => getenv('DB_USERNAME') !== false ? getenv('DB_USERNAME') : 'root',
        'clave' => getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '',
        'juego_caracteres' => 'utf8mb4',
    ],
];