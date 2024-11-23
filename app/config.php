<?php

namespace dwes\app;
use PDO;

//Conté varies seccions que configuren aspectes claus del projecte.
return [
    'database' => [
        'name' => 'projecteHotel',
        'username' => 'usercurso',
        'password' => 'php',
        'connection' => 'mysql:host=dwes.projecte',
        'options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ]
    ],
    'logs' => [
        'filename' => 'hotel.log',
        'level' => \Monolog\Logger::WARNING
    ],
    'routes' => [
        'filename' => 'routes.php'
    ],
    'project' => [
        'namespace' => 'dwes'
    ],
    'security' => [
        'roles' => [
            'ROLE_ADMIN' => 3,
            'ROLE_USER' => 2,
            'ROLE_ANONYMOUS' => 1
        ]
    ]

];
