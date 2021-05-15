<?php

include('vendor/autoload.php'); //sert à charger toute les classes du vendor

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //Initialise dotEnv avec le dossier courant
$dotenv->load(); //charger et parser le fichier .env

Sentry\init(['dsn' => $_ENV['SENTRY_URL']]); //Initialiser Sentry avec la clef D'API

// demarre une session
session_start();

//Initialise le router
$router = new Router($_GET['url']);

//include routes
$router->includeRoutes();

//lance le routeur pour trouver la route
$router->run();
