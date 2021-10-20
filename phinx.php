<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds'=> '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' =>
    [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' =>
        [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'yammp_test',
            'user' => 'root',
            'pass' => '',
            'port' => 3309,
            'charset' => 'utf8',
        ],
        'production' =>
        [
            'adapter' => $_ENV['DB_CONNECTION'],
            'host' => $_ENV['DB_HOSTNAME'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'pass' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => 'utf8',
        ],
    ],
];