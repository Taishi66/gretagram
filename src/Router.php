<?php

class Router
{
    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = []; //contiendra la liste des routes
    private $render;

    public function __construct($url = null)
    {
        $this->url = $url;
        $this->render = new Render();
    }


    //Récupère les données en GET
    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    //Envoie les données en POST
    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }



    /**
     * Instancie un nouvel objet Route, si le callable est une string
     * et que le $name est null alors il prends la valeur du callable.
     * Si il ya un $name
     *
     * @param $path !nécessaire au construct de la classe Route!
     * @param $callable !nécessaire au construc de la classe Route!
     * @param $name
     * @param $method
     *
     * @return la route!
     */
    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->$name = $route;
        }
        return $route;
    }


    /**
     * Verifie que la route n'existe pas dans la superglobal SERVEUR
     * Si true alors message d'erreur dans la console
     * Boucle qui parcours l'ensemble des routes de $_SERVEUR
     * S'il y a une correspondance (match) avec l'url alors la
     * route trouvée est appelée
     *
     * @return bool
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            error_log('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        error_log('No matching routes for ' . $this->url);
        $this->render->renderErrorNotFound();
    }


    /**
     * Déclenche l'appel au controller adéquat en fonction de la page demandée par l'utilisateur.
     *
     * @param PDO $bdd Objet de connexion à la BDD.
     */
    /*function getPage()
    {

        switch ($this->page) {
            case '':
                $user = new UserController();
                return $user->seConnecter();
                // break;
            case 'login':
                $user = new UserController();
                return $user->seConnecter();
                // break;
            case 'inscription':
                $user = new UserController();
                return $user->nouvelleInscription();
                //break;
            case 'noAccount':
                $user = new UserController();
                return $user->nouveauCompte(SessionFacade::getUserId());
                //  break;
            case 'article':
                $article = new ArticleController();
                return $article->afficheArticleController();
                //break;
            case 'delete_com':
                $commentaire = new CommentaireController();
                return $commentaire->supprimerCommentaire();
                //break;
            case 'profil':
                $user = new UserController();
                return $user->afficherMonprofil(SessionFacade::getUserId(), CompteFacade::getCompteId());
                //break;
            case 'compte':
                $compte = new compteController();
                return $compte->afficheProfil($_GET['id_compte']);
                //break;
            case 'home':
                $articles = new ArticleController();
                return $articles->showLastArticles();
                //break;
            case 'inbox':
                include('view/inbox.php');
                break;
            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                header('Location:/');
                break;
            case 'recherche':
                $result = new RechercheController();
                return $result->recherche(@$_GET['q']);
                //break;
            case 'explore':
                $compte = new CompteController();
                return $compte->afficherToutLesComptes();
                //break;
            default:
                header('location:/home');
                break;
        }
    }*/

    public function includeRoutes()
    {
        //Route login pour se connecter
        $this->get('/', 'User#seConnecter');
        $this->post('/', 'User#seConnecter');
        //Si user non connecté alors retour à la page d'incription
        $this->get('Inscription', 'User#nouvelleInscription');
        $this->post('Inscription', 'User#nouvelleInscription');
        //Route pour se créer un compte
        $this->get('NoAccount', 'Compte#nouveauCompte');
        $this->post('NoAccount', 'Compte#nouveauCompte');
        //Route accessible si connecté
        if (!empty(SessionFacade::getUserSession())) {
            $this->get('Instagram', 'Instagram#afficherMesMedias');
            $this->get('Profil', 'User#afficherMonprofil');
            $this->post('Profil', 'User#afficherMonprofil');
            //Route pour voir un article
            $this->get('Article', 'Article#afficheArticleController');
            $this->post('Article', 'Article#afficheArticleController');
            //Route pour effacer un commentaire
            $this->get('Delete_com', 'Commentaire#supprimerCommentaire');
            $this->post('Delete_com', 'Commentaire#supprimerCommentaire');
            //Route pour se déconnecter
            $this->get('Deconnexion', 'User#deconnexion');
            //Route pour voir le feed des derniers posts
            $this->get('Home', 'Article#AfficherDerniersArticles');
            $this->post('Home', 'Article#AfficherDerniersArticles');
            //Route pour voir l'ensemble des comptes
            $this->get('Explore', 'Compte#afficherToutLesComptes');
            //Route pour rediriger vers la visite d'un compte
            $this->get('Compte/:id_compte', 'Compte#afficheProfil');
            //Pour envoyer un message au compte visité
            $this->post('Compte/:id_compte', 'Inbox#envoyerMessage');
            //Pour voir mes discussions 
            $this->get('Inbox', 'Inbox#mesDiscussions');
            //Pour voir une conversation
            $this->get('Inbox/:id_compte', 'Inbox#maConversation');
            $this->post('Inbox/:id_compte', 'Inbox#messageChat');
            //Route pour rechercher un profil
            $this->get('Recherche', 'Recherche#recherche');
            //Se déconnecter
            $this->get('Deconnexion', 'User#deconnexion');
            //  } else {
            //    echo '<center><div class="alert alert-primary m-auto p-2">Connectez vous ou inscrivez vous pour pouvoir profiter de Gretagram!</div></center>';
        }
    }
}
