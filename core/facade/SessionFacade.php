<?php

/**
 * Facade données USER
 */
class SessionFacade
{
    private static $user;

    public static function setUserSession($user)
    {
        static::$user = $user;
        $_SESSION['user'] = $user;
    }

    public static function getUserSession()
    {
        if (empty(static::$user)) {
            static::$user = $_SESSION['user'];
        }
        return static::$user;
    }

    public static function getUserName()
    {
        return self::getUserSession()['nom'];
    }

    public static function getUserPrenom()
    {
        return self::getUserSession()['prenom'];
    }

    public static function getUserId()
    {
        return self::getUserSession()['id_user'];
    }

    public static function clearSession()
    {
        unset($_SESSION['user']);
        unset(static::$user['user']);
        return Header('Location:/');
    }
}
