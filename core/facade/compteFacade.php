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
        $id_user = SessionFacade::getUserId();
        static::$id_user = $id_user;

        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM compte
                INNER JOIN user ON user.id_user = compte.id_user
                WHERE compte.id_user = :id_user');
        $sql->execute([":id_user" => $id_user]);
        static::$compte = $sql->fetch(PDO::FETCH_ASSOC);
        //var_dump(static::$compte);
        return static::$compte;
    }

    static function getCompteId()
    {
        return self::getUserCompte(static::$id_user)['id_compte'];
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
