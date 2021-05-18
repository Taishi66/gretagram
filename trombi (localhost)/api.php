<?php

include("bdd.php");

class Api
{
    private $page;

    public function __construct($page = null)
    {
        $this->page = $page;
    }

    public function getPage()
    {

        switch ($this->page) {
            case 'profils':
                include("controller/jsonController.php");
                $profils = new JsonController();
                echo $profils->AfficheListeProfilsJson();
                break;
        }
    }
}

$api = new Api(@$_GET["page"]);
$api->getPage();
