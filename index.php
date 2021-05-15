<?php

include('vendor/autoload.php'); //sert à charger toute les classes du vendor

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Sentry\init(['dsn' => $_ENV['SENTRY_URL']]); //clef du projet sur Sentry de guillaume

// demarre une session
session_start();

$router = new Router($_GET['url']);

//include routes
$router->includeRoutes();

//lance le routeur pour trouver la route
$router->run();
