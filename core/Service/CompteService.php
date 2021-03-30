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

    public function getTopArticles()
    {
    }
}
