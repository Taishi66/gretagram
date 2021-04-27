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
include("controller/likeController.php");

include("model/CompteModel.php");
include("model/ArticleModel.php");
include("model/CommentaireModel.php");
include("model/UserModel.php");
include("model/RechercheModel.php");
include('model/likeModel.php');


require_once("Render.php");
require_once("Router.php");
require_once("Routes.php");


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



$router = new Router($_GET['url']);
//Route nécessaire afin de ne pas créer une erreur, chrome cherche automatiquement le favicon.
$router->get('/favicon.ico', function () {
});

//Route login pour se connecter
$router->get('/', 'User#seConnecter');
$router->post('/', 'User#seConnecter');
//Si user non connecté alors retour à la page d'incription
$router->get('inscription', 'User#nouvelleInscription');
$router->post('inscription', 'User#nouvelleInscription');
//Route pour se créer un compte
$router->get('noAccount', 'Compte#nouveauCompte');
$router->post('noAccount', 'Compte#nouveauCompte');
//Route pour aller au compte du profil connecté
if (!empty(SessionFacade::getUserSession())) {
    $router->get('profil', 'User#afficherMonprofil');
    $router->post('profil', 'User#afficherMonprofil');
    //Route pour voir un article 
    $router->get('article', 'Article#afficheArticleController');
    $router->post('article', 'Article#afficheArticleController');
    //Route pour effacer un commentaire
    $router->get('delete_com', 'Commentaire#supprimerCommentaire');
    $router->post('delete_com', 'Commentaire#supprimerCommentaire');
    //Route pour se déconnecter
    $router->get('deconnexion', 'User#deconnexion');
    //Route pour voir le feed des derniers posts
    $router->get('home', 'Article#showLastArticles');
    $router->post('home', 'Article#showLastArticles');
    //Route pour voir l'ensemble des comptes
    $router->get('explore', 'Compte#afficherToutLesComptes');
    //Route pour rediriger vers la visite d'un compte 
    $router->get('compte/:id_compte', 'Compte#afficheProfil');
    $router->get('compte', 'Compte#afficheProfil');
    //Route pour rechercher un profil
    $router->get('recherche', 'Recherche#recherche');
    //Se déconnecter
    $router->get('deconnexion', 'User#deconnexion');
} else {
    $router->get('/', 'User#seConnecter');
    $router->post('/', 'User#seConnecter');
    //Si user non connecté alors retour à la page d'incription
    $router->get('inscription', 'User#nouvelleInscription');
    $router->post('inscription', 'User#nouvelleInscription');
    //Route pour se créer un compte
    $router->get('noAccount', 'Compte#nouveauCompte');
    $router->post('noAccount', 'Compte#nouveauCompte');
}




$vars = $router->run();

if (!$vars) {
    echo 'page introuvable';
    exit;
}

$render = new Render();
$vars['datas']['user'] = SessionFacade::getUserSession();

$header = $render->renderHeader($vars['datas']);
$content = $render->renderContent($vars['template'], $vars['datas']);
$footer = $render->renderFooter($vars['datas']);

return $render->showPage($header, $content, $footer);
