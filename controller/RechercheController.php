<?php

class RechercheController extends ManagerController
{
    private $rechercheModel;

    function __construct()
    {
        $this->rechercheModel = new rechercheModel();
        parent::__construct(); //validatorHelper est le parent
    }


    public function recherche()
    {
        $q = $this->validatorHelper->getValue("q");
        if ($q !== null) {
            $this->template = "view_page/recherche.php";
            $q = $this->validatorHelper->getValue("q");
            $resultat = $this->rechercheModel->research($q);
            $this->setSearch($resultat);
            return $this->renderController();
        } else {
            $this->template = "error404.php";
            return $this->renderController();
        }
    }
}
