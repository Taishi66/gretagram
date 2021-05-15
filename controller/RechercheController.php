<?php

class RechercheController extends ManagerController
{
    private $rechercheModel;

    public function __construct()
    {
        $this->rechercheModel = new rechercheModel();
        parent::__construct(); //validatorHelper est le parent
    }


    public function recherche()
    {   //On récupère la valeur de l'input
        $q = $this->validatorHelper->getValue("q");
        if ($q !== null && !empty($q)) {
            $this->template = "view_page/recherche.php";
            $q = $this->validatorHelper->getValue("q");
            $resultat = $this->rechercheModel->research($q);
            $this->setSearch($resultat);
            return $this->renderController();
        } else {
            $this->setMessage('Aucune correspondance', 'warning');
            return $this->renderController();
        }
    }
}
