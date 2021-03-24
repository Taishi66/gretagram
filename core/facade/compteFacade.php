<?php

class compteFacade
{
    static private $user;
    static private $compte;

    /**
     * Method setUserCompte
     *
     * @param $user $user [explicite description]
     *
     * @return void
     */
    static function setUserCompte($user)
    {
        static::$user = $user;
        $_SESSION['user'] = $user;

        $bdd = Bdd::Connexion();
        $compte = $bdd->query('SELECT * FROM compte
                INNER JOIN user ON user.id_user = compte.id_user
                INNER JOIN article ON article.id_compte = compte.id_compte
                WHERE compte.id_user = user.id_user')->fetchAll(PDO::FETCH_ASSOC);

        static::$compte = $compte;
    }

    static function getUserCompte($compte)
    {
        if (empty(static::$user)) {
            static::$user = $_SESSION['user'];
            $compte = self::setUserCompte(static::$user);
        }
        return static::$compte;
    }

    static function getComptePseudo()
    {
        return self::getUserCompte(static::$compte)['pseudo'];
    }

    static function getCompteDescription()
    {
        return self::getUserCompte(static::$compte)['description_compte'];
    }

    static function getComptePhoto()
    {
        return self::getUserCompte(static::$compte)['photo'];
    }
}
