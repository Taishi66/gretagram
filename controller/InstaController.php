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
        $this->setArticle($this->insta->getMedias()); //récupère les donnés des articles de mon compte instagram!

        return $this->renderController();
    }
}
