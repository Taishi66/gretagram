<?php
// demarre une session
session_start();

require_once("core/Bdd.php");
include("core/Helper/ValidatorHelper.php");
include("core/Helper/UploadHelper.php");
include("core/Helper/DebugHelper.php");
include("core/facade/SessionFacade.php");
include("core/facade/CompteFacade.php");
include("core/facade/DebugFacade.php");
include("core/Service/CompteService.php");
include("core/Service/InstagramService.php");


include("controller/ManagerController.php");
include("controller/CompteController.php");
include("controller/ArticleController.php");
include("controller/CommentaireController.php");
include("controller/UserController.php");
include("controller/RechercheController.php");
include("controller/LikeController.php");
include("controller/InstaController.php");

include("model/compteModel.php");
include("model/articleModel.php");
include("model/commentaireModel.php");
include("model/userModel.php");
include("model/rechercheModel.php");
include('model/likeModel.php');


require_once("Render.php");
require_once("Router.php");
require_once("Routes.php");




$router = new Router($_GET['url']);
//Route nécessaire afin de ne pas créer une erreur, chrome cherche automatiquement le favicon.
$router->get('/favicon.ico', function () {
});

//Route login pour se connecter
$router->get('/', 'User#seConnecter');
$router->post('/', 'User#seConnecter');
//Si user non connecté alors retour à la page d'incription
$router->get('Inscription', 'User#nouvelleInscription');
$router->post('Inscription', 'User#nouvelleInscription');
//Route pour se créer un compte
$router->get('NoAccount', 'Compte#nouveauCompte');
$router->post('NoAccount', 'Compte#nouveauCompte');
//Route pour aller au compte du profil connecté
if (!empty(SessionFacade::getUserSession())) {
    $router->get('Instagram', 'Instagram#afficherMesMedias');
    $router->get('Profil', 'User#afficherMonprofil');
    $router->post('Profil', 'User#afficherMonprofil');
    //Route pour voir un article 
    $router->get('Article', 'Article#afficheArticleController');
    $router->post('Article', 'Article#afficheArticleController');
    //Route pour effacer un commentaire
    $router->get('Delete_com', 'Commentaire#supprimerCommentaire');
    $router->post('Delete_com', 'Commentaire#supprimerCommentaire');
    //Route pour se déconnecter
    $router->get('Deconnexion', 'User#deconnexion');
    //Route pour voir le feed des derniers posts
    $router->get('Home', 'Article#AfficherDerniersArticles');
    $router->post('Home', 'Article#AfficherDerniersArticles');
    //Route pour voir l'ensemble des comptes
    $router->get('Explore', 'Compte#afficherToutLesComptes');
    //Route pour rediriger vers la visite d'un compte 
    $router->get('Compte/:id_compte', 'Compte#afficheProfil');
    $router->get('Compte', 'Compte#afficheProfil');
    //Route pour rechercher un profil
    $router->get('Recherche', 'Recherche#recherche');
    //Se déconnecter
    $router->get('Deconnexion', 'User#deconnexion');
} else {
    $router->get('/', 'User#seConnecter');
    $router->post('/', 'User#seConnecter');
    //Si user non connecté alors retour à la page d'incription
    $router->get('Inscription', 'User#nouvelleInscription');
    $router->post('Inscription', 'User#nouvelleInscription');
    //Route pour se créer un compte
    $router->get('NoAccount', 'Compte#nouveauCompte');
    $router->post('NoAccount', 'Compte#nouveauCompte');
}



//lance le routeur pour trouver la route
$vars = $router->run();

if (!$vars) {
    echo 'page introuvable';
    exit;
}

$render = new Render();
//les datas de l'user connecté seront renvoyées sur chaque nouvelle page
$vars['datas']['user'] = SessionFacade::getUserSession();


/*Les variables contiennent les méthodes de la classe Render puis 
utilisée en tant que paramètre de la méthode showpage() qui décide de l'ordre de présentation
des vues.
Dans ce cas c'est donc l'index qui renvoit la vue correspondante et non le contrôleur*/
$header = $render->renderHeader($vars['datas']);
$content = $render->renderContent($vars['template'], $vars['datas']);
$footer = $render->renderFooter($vars['datas']);
//cela permet de meilleur performance et un meilleur paramètrage du site
return $render->showPage($header, $content, $footer);
