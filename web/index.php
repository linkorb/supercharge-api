<?php

use Graphael\Server;
use Symfony\Component\Dotenv\Dotenv;

$loader = require_once __DIR__.'/../vendor/autoload.php';

if (class_exists('AutoTune\Tuner')) {
    \AutoTune\Tuner::init($loader);
}

// Load .env file if it exists
$envFilename = __DIR__.'/../.env';
if (file_exists($envFilename)) {
    $dotenv = new Dotenv();
    $dotenv->load($envFilename);
}

$config = [
    'environment_prefix' => 'SUPERCHARGE_API_',
    'type_namespace' => 'SuperCharge\\Api',
    'type_path' => __DIR__.'/../src',
];

$server = new Server($config);
$server->handleRequest();
