<?php

class InstagramController extends ManagerController
{
    private $insta;

    public function __construct()
    {
        $this->insta = new InstagramService();
        parent::__construct();
    }

    public function afficherMesMedias()
    {
        $this->template = "view_profil/profil_Insta.php";
        $this->setArticle($this->insta->getMedias()); //récupère les donnés des articles de mon compte instagram!

        return $this->renderController();
    }
}
