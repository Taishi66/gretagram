<?php

class Bdd
{

        public static function Connexion()
        {
                try {
                        $bdd = new PDO("mysql:host=localhost;dbname=testEsat", 'taishi', 'tokyo2020');
                } catch (Exception $e) {
                        die('erreur de connexion à la bdd <br> $e');
                }
                return $bdd;
        }
}
