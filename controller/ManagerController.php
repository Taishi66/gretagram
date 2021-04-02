<?php

class ManagerController
{

    public $message = null;
    public $template = null;
    private $compte;
    private $article;
    private $commentaire;

    public $validatorHelper;

    public function __construct()
    {
        if (SessionFacade::getUserId()) {
            $this->compte = CompteFacade::getUserCompteFromUser(SessionFacade::getUserId());
        }
        $this->validatorHelper = new ValidatorHelper();
    }

    public function renderController()
    {
        return [
            'template' => $this->template,
            'datas' => $this->buildDatas()
        ];
    }

    public function buildDatas()
    {
        $output = [];
        if (!empty($this->getMessage())) {
            $output['message'] = $this->getMessage();
        }
        if (!empty($this->getCompte())) {
            $output['compte'] = $this->getCompte();
        }
        if (!empty($this->getArticle())) {
            $output['article'] = $this->getArticle();
        }
        if (!empty($this->getCom())) {
            $output['commentaire'] = $this->getCom();
        }
        $output['user'] = SessionFacade::getUserSession();

        return $output;
    }

    public function getMessage()
    {
        return $this->message;
    }

    /*public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        return $this->template = $template;
    }*/

    public function getCompte()
    {
        return $this->compte;
    }

    public function setMessage($message, $type = 'success')
    {
        $this->message = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public function setCompte($compte)
    {
        $this->compte = $compte;
    }

    public function setArticle($article)
    {
        $this->article = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }


    public function setCom($commentaire)
    {
        $this->commentaire = $commentaire;
    }
    public function getCom()
    {
        return $this->commentaire;
    }


    public function redirectTo($page)
    {
        header('Location:?page=' . $page);
    }
}
