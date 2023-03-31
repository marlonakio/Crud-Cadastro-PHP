<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Slim\Factory\AppFactory;

$app = AppFactory::create();

require_once __DIR__ . '/router/web.php';
$app->addErrorMiddleware(true, false, false);
$app->run();
