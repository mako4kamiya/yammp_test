<?php

if (!$_ENV['CLEARDB_DATABASE_URL']) {
    require 'vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds'=> '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' =>
    [
        'default_migration_table' => 'phinxlog',
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