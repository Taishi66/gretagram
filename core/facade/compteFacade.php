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
    static function getUserCompte($id_user)
    {
        $compteService = new CompteService();
        return $compteService->getCompte($id_user);
    }

    static function getCompteId()
    {
        $compteService = new CompteService();
        return $compteService->getCompteFromUser(SessionFacade::getUserId())['id_compte'];
    }

    static function getComptePseudo()
    {
        return self::getUserCompte(static::$id_user)['pseudo'];
    }

    static function getCompteDescription()
    {
        return self::getUserCompte(static::$id_user)['description_compte'];
    }

    static function getComptePhoto()
    {
        return self::getUserCompte(static::$id_user)['photo'];
    }
}
