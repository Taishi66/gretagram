<?php
// demarre une session
//session_start();

require_once("bdd/bdd.php");

include("view/header.php");

include("controller/profilsController.php");

require_once("Router.php");

$router = new Router(@$_GET["page"]); // On récupère la valeur associée à la clé "page" dans l'url
// exemple localhost/index.php?page=profils 
$router->getPage();


include("view/footer.php");
