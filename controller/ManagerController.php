<?php

/**
 * ManagerController
 * CLASSE PARENTE ET HERITAGE DE CHAQUE CONTROLLER
 */
class ManagerController //
{

    public $message = null;
    public $template = null;
    private $compte;
    private $article;
    private $commentaire;
    private $recherche;
    private $compteVisite;
    private $suggestion;

    private $nbLikesForArticle;
    private $articleAlreadyLiked;
    public $validatorHelper;
    public $uploadHelper;

    /**
     * S'il ya un User connecté au moment de son appel, $compte prendra en valeur ses données
     */
    public function __construct()
    {
        if (SessionFacade::getUserId()) {
            $this->compte = CompteFacade::getUserCompteFromUser(SessionFacade::getUserId());
        }
        $this->validatorHelper = new ValidatorHelper();
        $this->uploadHelper = new UploadHelper();
    }

    /**
     * Renvoie la vue et un array de données
     */
    public function renderController()
    {
        return [
            'template' => $this->template,
            'datas' => $this->buildDatas()
        ];
    }

    /**
     * Me permet de créer un array contenant toute les datas nécessaires
     * aux requêtes utilisateur à l'aide de setter/getter
     */
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
        if (!empty($this->getSearch())) {
            $output['recherche'] = $this->getSearch();
        }
        if (!empty($this->getCompteVisite())) {
            $output['compteVisite'] = $this->getCompteVisite();
        }
        if (!empty($this->getSuggestion())) {
            $output['suggestion'] = $this->getSuggestion();
        }

        if (!empty($this->getNbLikesForArticle())) {
            $output['nbLikesForArticle'] = $this->getNbLikesForArticle();
        }
        if (!empty($this->getArticleAlreadyLiked())) {
            $output['articleAlreadyLiked'] = $this->getArticleAlreadyLiked();
        }

        $output['user'] = SessionFacade::getUserSession();

        return $output;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message, $type = 'success')
    {
        $this->message = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public function getSearch()
    {
        return $this->recherche;
    }

    public function setSearch($recherche)
    {
        return $this->recherche = $recherche;
    }

    public function getSuggestion()
    {
        return $this->suggestion;
    }

    public function setSuggestion($suggestion)
    {
        return $this->suggestion = $suggestion;
    }

    public function getCompte()
    {
        return $this->compte;
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

    public function setCompteVisite($compteVisite)
    {
        $this->compteVisite = $compteVisite;
    }

    public function getCompteVisite()
    {
        return $this->compteVisite;
    }




    public function setNbLikesForArticle($nbLikesForArticle)
    {
        $this->nbLikesForArticle = $nbLikesForArticle;
    }

    public function getNbLikesForArticle()
    {
        return $this->nbLikesForArticle;
    }

    public function setArticleAlreadyLiked($articleAlreadyLiked)
    {
        $this->articleAlreadyLiked = $articleAlreadyLiked;
    }

    public function getArticleAlreadyLiked()
    {
        return $this->articleAlreadyLiked;
    }


    public function redirectTo($page)
    {
        header('Location:/' . $page);
    }
}
