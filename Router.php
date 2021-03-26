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
                $profil = new ProfilsController();
                return $profil->getLogin();
                // break;
            case 'inscription':
                $profil = new ProfilsController();
                return $profil->setInscription();
                //break;
            case 'noAccount':
                var_dump(SessionFacade::getUserId() . '=router');
                $profil = new ProfilsController();
                return $profil->newAccount(SessionFacade::getUserId());
                //  break;
            case 'monProfil':
                $profil = new ProfilsController();
                $article = new ArticleController();
                if (!empty($_POST['titre']) && !empty($_POST['media']) && !empty($_POST['contenu'])) {
                    $article->newArticle($_POST['media'], $_POST['titre'], $_POST['contenu'], $_POST['date_art'], CompteFacade::getCompteId());
                    return $profil->afficherMonprofil(SessionFacade::getUserId(), CompteFacade::getCompteId());
                    exit;
                }
                return $profil->afficherMonprofil(SessionFacade::getUserId(), CompteFacade::getCompteId());
                //break;
            case 'home':
                // $profil = new ProfilsController();
                //return $profil->afficherListeProfils();
                break;
            case 'inbox':
                include('view/inbox.php');
                break;
            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                // redirection vers pas login
                header('Location:?page=');
                break;
                /*default:
                header('location:index.php');
                break;*/
        }
    }
}
