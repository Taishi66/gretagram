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
                var_dump($_SESSION['id_user'] . '=id_user');
                $profil = new ProfilsController();
                return $profil->setInscription();
                //break;
            case 'noAccount':
                var_dump(@$_SESSION["id_user"] . '=router');
                $profil = new ProfilsController();
                return $profil->newAccount(@$_SESSION["id_user"]);
                //  break;
            case 'monProfil':
                $profil = new ProfilsController();
                $profil->afficherMonprofil(@$_SESSION["id_user"]);
                var_dump(@$_SESSION["id_user"] . '=id_user');
                break;
            case 'home':
                ///include("view/home.php");
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
