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
            case 'json':
                include("controller/jsonController.php");
                $profils = new JsonController();
                $data = $_GET['data'];
                switch ($data) {
                    case 'profils':
                        echo $profils->AfficheListeProfilsJson();
                        break;
                }
                break;
                
            case 'adminAjax':
                include("view/viewListeAjax.php");
                break;

            case 'profils':
                $profils = new ProfilsController();
                $profils->AfficheListeProfils();
                break;

            case 'profil':
                $profil = new ProfilsController();
                $profil->AfficheProfil(@$_GET["id"]);
                break;

            case 'monProfil':
                $profil = new ProfilsController();
                $profil->AfficheProfil(@$_SESSION["id_user"]);
                break;

            case 'inscription':
                $profil = new ProfilsController();
                $profil->setInscription();
                break;

            case 'connexion':
                $profil = new ProfilsController();
                $profil->getConnexion();
                break;

            case 'deconnexion':
                // vide la session et donc je me deconnecte
                $_SESSION = array();
                // redirection vers index.php
                header('Location: index.php');
                break;

            case 'recherche':
                include("controller/rechercheController.php");
                $recherche = new RechercheController();
                $recherche->AfficheChercher(@$_GET["q"]);
                break;


            default:
                $profils = new ProfilsController();
                $profils->AfficheListeProfils();
                break;
        }
    }
}
