<?php

/**
 * Facade données USER
 */
class SessionFacade
{

    static private $user;

    static function setUserSession($user)
    {
        static::$user = $user;
        $_SESSION['user'] = $user;
    }

    static function getUserSession()
    {
        if (empty(static::$user)) {
            static::$user = $_SESSION['user'];
        }
        return static::$user;
    }

    static function getUserName()
    {
        return self::getUserSession()['nom'];
    }

    static function getUserPrenom()
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
        return Header('Location:/');
    }
}
