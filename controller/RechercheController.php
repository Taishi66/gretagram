<?php

class RechercheController extends ManagerController
{
    private $rechercheModel;

    function __construct()
    {
        $this->rechercheModel = new RechercheModel();
        parent::__construct();
    }


    public function recherche()
    {
        $q = $this->validatorHelper->getValue("q");
        if ($q !== null) {
            $this->template = "recherche.php";
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
