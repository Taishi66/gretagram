<?php

/**
 * declaration de la class Bdd
 */
class Bdd
{
    //  methode static
    public static function Connexion()
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=gretagram2021", "taishi", "tokyo2020", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //   $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $bdd;
        } catch (Exception $e) {
            die('erreur de connexion à la bdd <br> $e');
        }
    }
}
