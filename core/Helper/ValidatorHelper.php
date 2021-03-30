<?php

class ValidatorHelper
{
    public function __construct()
    {
    }

    public function getValue($key, $default_value, $typeOfValue = '')
    {
        if (empty($key) || !is_string($key)) {
            return false;
        }

        $value = '';
        if (isset($_POST[$key]) || isset($_GET[$key])) {
            $value = isset($_POST[$key]) ? $_POST[$key] : $_GET[$key];
        }

        if (!isset($value)) {
            $value = $default_value;
        }

        if ($typeOfValue == 'integer') {
            return (int) $value;
        }

        return $value;
    }


    public function verfNomPrenom($valeur)
    {
        $test = preg_match("#^[a-zA-Z._-\é\è\ê\' ]{2,50}$#", $valeur); // true ou false
        if ($test) {
            return $valeur; // true
        } else {
            return false;
        }
    }

    public function verfEmail($valeur)
    {
        if (preg_match("#^[a-z0-9._-]{2,50}+@[a-z0-9._-]{2,50}\.[a-z]{2,5}$#", $valeur)) {
            return $valeur; // true
        } else {
            return false;
        }
    }
}
