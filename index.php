<?php
// demarre une session
session_start();


require_once("core/Bdd.php");
include("core/Helper/ValidatorHelper.php");
include("core/Helper/DebugHelper.php");
include("core/facade/SessionFacade.php");
include("core/facade/CompteFacade.php");
include("core/facade/DebugFacade.php");
include("core/Service/CompteService.php");


include("controller/ManagerController.php");
include("controller/CompteController.php");
include("controller/ArticleController.php");
include("controller/CommentaireController.php");
include("controller/UserController.php");
include("controller/RechercheController.php");

include("model/CompteModel.php");
include("model/ArticleModel.php");
include("model/CommentaireModel.php");
include("model/UserModel.php");
include("model/RechercheModel.php");


require_once("Render.php");
require_once("Router.php");


/*
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,username,timestamp&access_token=IGQVJYMFNhM1c2dmxsb29qTXU3ZAUV2RUVtU25jTFNxTzliR1dxd2padjFRb2VpSHJPVnk4Ul93TkRZAVWw2ZAzFTd0lVSEJBX1BNN2xCdkFFbVpYZAEl6TklweEhjY2xVbHZAEQURLeUVB',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
var_dump($response);
exit;*/

$router = new Router(@$_GET["page"]); // On récupère la valeur associée à la clé "page" dans l'url
// exemple localhost/index.php?page=profils 
//$router->getPage();
$vars = $router->getPage();

$vars['datas']['user'] = SessionFacade::getUserSession();


$render = new Render();

$header = $render->renderHeader($vars['datas']);
$content = $render->renderContent($vars['template'], $vars['datas']);
$footer = $render->renderFooter($vars['datas']);


$render->showPage($header, $content, $footer);
