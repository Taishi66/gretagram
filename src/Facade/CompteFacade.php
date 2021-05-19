<?php

/**
 * Façade données du COMPTE de l'user connecté
 */
class CompteFacade
{
    private static $id_user;
    private static $compte;

    /**
     * Method setUserCompte
     *
     * @param $user $user [explicite description]
     *
     * @return void
     */
    public static function getUserCompte($id_compte)
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
    public static function getUserCompteFromUser($id_user)
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser($id_user);
    }

    /**
     * @return int $id_compte
     */
    public static function getCompteId()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['id_compte'];
    }

    public static function getComptePseudo()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['pseudo'];
    }

    public static function getCompteDescription()
    {
        return self::getUserCompteFromUser(static::$id_user)['description_compte'];
    }

    public static function getComptePhoto()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['photo'];
    }
    public static function getCompteArticle()
    {
        return self::getUserCompteFromUser(static::$id_user)['articles'];
    }

    public static function plusPublication()
    {
        $compteService = new CompteService();
        return $compteService->addPublications(CompteFacade::getCompteId());
    }

    public static function soustraitPublications()
    {
        $compteService = new CompteService();
        return $compteService->minusPublications(CompteFacade::getCompteId());
    }

    public static function getAllComFromAccount()
    {
        $compteService = new CompteService();
        return $compteService->AllComFromCompte(CompteFacade::getCompteId());
    }

    public static function EraseAccount()
    {
        $compteService = new CompteService();
        return $compteService->deleteAccount(CompteFacade::getCompteId());
    }
}
