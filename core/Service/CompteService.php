<?php


class CompteService
{

    private $compteModel = null;

    public function __construct()
    {
        $this->compteModel = new CompteModel();
    }

    /**
     * @var int $id_user
     * @return array $compte
     */
    public function getCompteFromUser($id_user = null)
    {
        return $this->compteModel->getCompteFromUser($id_user);
    }


    public function getCompte($id_compte = null)
    {
        if ($id_compte == null) {
            $id_compte = SessionFacade::getUserId();
        }

        $compte = $this->compteModel->getCompte($id_compte);
        $compte['articles'] = $this->compteModel->getArticles($id_compte);

        return $compte;
    }


    public function addPublications($id_compte)
    {
        $resultat = $this->compteModel->incrementerPublications($id_compte);
        return $resultat;
    }

    public function minusPublications($id_compte)
    {
        $resultat = $this->compteModel->decrementerPublications($id_compte);
        return $resultat;
    }

    public function AllComFromCompte($id_compte)
    {
        $resultat = $this->compteModel->getAllComFromCompte($id_compte);
        return $resultat;
    }

    public function deleteAccount($id_compte)
    {
        $resultat = $this->compteModel->deleteCompte($id_compte);
        // $_SESSION = array('');
        return $resultat;
    }
}
