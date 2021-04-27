<?php

class CompteFacade
{
    static private $id_user;
    static private $compte;


    /**
     * Method setUserCompte
     *
     * @param $user $user [explicite description]
     *
     * @return void
     */
    static function getUserCompte($id_compte)
    {
        $compteService = new CompteService();
        return $compteService->getCompte($id_compte);
    }

    /**
     * Method 
     *
     * @param $user $user [explicite description]
     *
     * @return void
     */
    static function getUserCompteFromUser($id_user)
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser($id_user);
    }

    /**
     * @return int $id_compte
     */
    static function getCompteId()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['id_compte'];
    }

    static function getComptePseudo()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['pseudo'];
    }

    static function getCompteDescription()
    {
        return self::getUserCompteFromUser(static::$id_user)['description_compte'];
    }

    static function getComptePhoto()
    {
        return self::getUserCompteFromUser(static::$id_user)['photo'];
    }
    static function getCompteArticle()
    {
        return self::getUserCompteFromUser(static::$id_user)['articles'];
    }

    static function plusPublication()
    {
        $compteService = new CompteService();
        return $compteService->addPublications(CompteFacade::getCompteId());
    }

    static function soustraitPublications()
    {
        $compteService = new CompteService();
        return $compteService->minusPublications(CompteFacade::getCompteId());
    }

    static function getAllComFromAccount()
    {
        $compteService = new CompteService();
        return $compteService->AllComFromCompte(CompteFacade::getCompteId());
    }

    static function EraseAccount()
    {
        $compteService = new CompteService();
        return $compteService->deleteAccount(CompteFacade::getCompteId());
    }
}
