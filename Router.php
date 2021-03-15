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
                //break;
            case 'inscription':
                $profil = new ProfilsController();
                return $profil->setInscription();
                //break;
            case 'nouveauCompte':
                $profil = new ProfilsController();
                return $profil->newAccount();
              //  break;
            case 'monProfil':
                $profil = new ProfilsController();
                return $profil->afficherMonprofil(@$_SESSION["id_user"]);
                // break;
            case 'home':
                ///include("view/home.php");
                break;
            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                // redirection vers pas login
                include('view/accueil.php');
                break;


                /* $profils = new ProfilsController();
                $profils->afficherListeProfils();
                break;*/
                /* 
            case 'noAccount':
                $profil = new ProfilsController();
                $profil->newAccount();
                break;
            case 'inbox':
                include("view/inbox.php");
                break;*/
                /*default:
                header('location:index.php');
                break;*/
        }
    }
}
