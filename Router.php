<?php

//include("view/header.php");

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
                $profil->getLogin();
                include("view/accueil.php");
                break;
            case 'inscription':
                $profil = new ProfilsController();
                $profil->setInscription();
                break;
            case 'monProfil':
                $profil = new ProfilsController();
                $profil->afficherMonprofil(@$_SESSION["id_user"]);
                break;
            case 'home':
                include("view/home.php");
            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                // redirection vers pas login
                header('Location: view/accueil.php');
                break;


                /* $profils = new ProfilsController();
                $profils->afficherListeProfils();
                break;*/
         /* case 'creAccount':
                $profil = new ProfilsController();
                $profil->newAccount();
                break;
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
