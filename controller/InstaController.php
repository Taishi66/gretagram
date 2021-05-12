<?php

class InstagramController extends ManagerController
{

    private $insta;

    function __construct()
    {
        $this->insta = new InstagramService();
        parent::__construct();
    }

    function afficherMesMedias()
    {
        $this->template = "profil/profil_Insta.php";
        $this->setArticle($this->insta->getMedias());

        return $this->renderController();
    }
}
