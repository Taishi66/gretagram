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
                return $user->getLogin();
                // break;
            case 'inscription':
                $user = new UserController();
                return $user->setInscription();
                //break;
            case 'noAccount':
                var_dump(SessionFacade::getUserId() . '=router');
                $user = new UserController();
                return $user->newAccount(SessionFacade::getUserId());
                //  break; 
            case 'article':
                $article = new ArticleController();
                return $article->afficheArticle();
                //break;
            case 'profil':
                $user = new UserController();
                return $user->afficherMonprofil(SessionFacade::getUserId(), CompteFacade::getCompteId());
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
            default:
                header('location:?page=home');
                break;
        }
    }
}
