<?php

class compteFacade
{

    static private $compte;

    static function setUserCompte($user)
    {
        static::$compte = $compte;
        $bdd = Bdd::Connexion();

    }

    static function getUserCompte()
    {
        if (empty(static::$user)) {
            static::$user = $_SESSION['user'];
        }
        return static::$user;
    }

    static function getComptePseudo()
    {
        return self::getUserCompte()['nom'];
    }

    static function getCompteDescription()
    {
        return self::getUserSession()['prenom'];
    }

    static function getUserId()
    {
        return self::getUserSession()['id_user'];
    }

    static function clearSession()
    {
        unset($_SESSION['user']);
        unset(static::$user['user']);
    }
}
