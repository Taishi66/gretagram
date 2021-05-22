<?php

class ValidatorHelper
{
    public function __construct()
    {
    }

    /**
     * Method getValue (vérifie leur valeur et sécurise en ajoutant une valeur par défault et en précisant le type)
     *
     * @param $key
     * @param $default_
     * @param $typeOfValue
     *
     * @return $value
     */
    public function getValue($key, $default_value = null, $typeOfValue = '') //protection injection sql
    {
        if (empty($key) || !is_string($key)) {
            return false;
        }

        $value = false;
        if (isset($_POST[$key]) || isset($_GET[$key])) {
            $value = isset($_POST[$key]) ? $_POST[$key] : $_GET[$key];
            /* CONDITION TERNAIRE
            if (isset($_POST[$key])) {
                return $_POST[$key];
            } else {
                return $_GET[$key];
            }*/
        }

        if (!isset($value)) {
            $value = $default_value;
        }

        if (is_integer($typeOfValue)) {
            return (int) $value;
        }

        return $value;
    }



    /**
     * Method pour checker le nom et le prenom
     *
     * @param $valeur
     *
     * @return void
     */
    public function verfNomPrenom($valeur)
    {
        $test = preg_match("#^[a-zA-Z._-\é\è\ê\' ]{2,50}$#", $valeur); // true ou false
        if ($test) {
            return $valeur; // true
        } else {
            return false;
        }
    }

    /**
     * Method Regex pour vérifier le mail
     *
     * @param $valeur
     *
     * @return void
     */
    public function verfEmail($valeur)
    {
        if (preg_match("#^[a-z0-9._-]{2,50}+@[a-z0-9._-]{2,50}\.[a-z]{2,5}$#", $valeur)) {
            return $valeur; // true
        } else {
            return false;
        }
    }
}
