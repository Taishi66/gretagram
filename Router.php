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
            case 'inscription':
                $profil = new ProfilsController();
                $profil->setInscription();
                break;
            case 'creAccount':
                $profil = new ProfilsController();
                $profil->newAccount();
                break;
            case 'profils':
                $profils = new ProfilsController();
                $profils->afficherListeProfils();
                break;
            case 'monProfil':
                $profil = new ProfilsController();
                $profil->afficherMonprofil(@$_SESSION["id_user"]);
                break;
            case 'login':
                $profil = new ProfilsController();
                $profil->getLogin();
                break;
            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                // redirection vers index.php
                header('Location: index.php');
                break;
            case 'noAccount':
                $profil = new ProfilsController();
                $profil->newAccount();
                break;
            case 'contact':
                include("view/contact.php");
                break;
                /*default:
                header('location:index.php');
                break;*/
        }
    }
}
