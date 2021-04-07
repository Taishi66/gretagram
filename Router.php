<?php
class Router
{
    private $page;

    public function __construct($page = null)
    {
        $this->page = $page;
    }

    /**
     * Déclenche l'appel au controller adéquat en fonction de la page demandée par l'utilisateur.
     * 
     * @param PDO $bdd Objet de connexion à la BDD.
     */
    function getPage()
    {

        switch ($this->page) {
            case '':
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
                header('Location:?page=');
                break;
            case 'recherche':
                $result = new RechercheController();
                return $result->recherche(@$_GET['q']);
                //break;
            case 'explore':
                $explore = new RechercheController();
                return $explore->explorer(@$_GET['e']);
                //break;
            default:
                header('location:?page=home');
                break;
        }
    }
}
