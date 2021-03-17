<?php
// demarre une session
session_start();


require_once("bdd/bdd.php");
include("controller/profilsController.php");
include("facade/SessionFacade.php");
require_once("Router.php");
require_once('render.php');

$router = new Router(@$_GET["page"]); // On récupère la valeur associée à la clé "page" dans l'url
// exemple localhost/index.php?page=profils 
//$router->getPage();
$vars = $router->getPage();

$vars['datas']['user'] = SessionFacade::getUserSession();

$render = new Render();

$header = $render->renderHeader($vars['datas']);
$content = $render->renderContent($vars['template'], $vars['datas']);
$footer = $render->renderFooter($vars['datas']);

//session_start();

$render->showPage($header, $content, $footer);

