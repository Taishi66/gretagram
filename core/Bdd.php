<?php

/**
 * declaration de la class Bdd
 */
class Bdd
{
    private static $bdd = null;

    //  methode static
    public static function Connexion()
    {
        if (self::$bdd === null) {
            try {
                $bdd = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_DATABASE'], $_ENV['DB_PASSWORD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                //   $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$bdd = $bdd;
            } catch (Exception $e) {
                die('erreur de connexion à la bdd <br> $e');
            }
        }

        return self::$bdd;
    }
}
