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
            case 'profils':
                $profils = new ProfilsController();
                $profils->afficherListeProfils();
                break;
            case 'login':
                $profil = new ProfilsController();
                $profil->getLogin();
                break;
           /* case 'monProfil':
                $profils = new ProfilsController();
                $profils->afficherMonProfil();
                break;*/
        }
    }
}