<?php


class CompteController
{
    private $articleController;
    private $compteModel;

    function __construct()
    {
        $this->articleController = new ArticleController();
        $this->compteModel = new CompteModel();
    }

    function addPublications($id_compte)
    {
        $resultat = $this->compteModel->incrementerPublications($id_compte);
        return $resultat;
    }
}
