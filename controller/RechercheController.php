<?php

class RechercheController extends ManagerController
{
    private $rechercheModel;

    function __construct()
    {
        $this->rechercheModel = new RechercheModel();
        parent::__construct();
    }


    public function recherche($q = null)
    {
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

    public function explorer($e = null)
    {
        $this->template = "explore.php";
        if ($e !== null) {
            $e = $this->validatorHelper->getValue("e");
            $resultat = $this->rechercheModel->research($e);
            $this->setSearch($resultat);
            return $this->renderController();
        } else {
            $this->template = "error404.php";
            return $this->renderController();
        }
        return $this->renderController();
    }
}
