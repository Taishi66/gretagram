<?php

class ValidatorHelper
{

    public function __construct()
    {
    }

    /**
     * Method getValue (au lieu d'utiliser superVariable $_GET, c'est plus sécurisé )
     *
     * @param $key $key [explicite description]
     * @param $default_value $default_value [explicite description]
     * @param $typeOfValue $typeOfValue [explicite description]
     *
     * @return $value
     */
    public function getValue($key, $default_value = null, $typeOfValue = '')
    {
        if (empty($key) || !is_string($key)) {
            return false;
        }

        $value = false;
        if (isset($_POST[$key]) || isset($_GET[$key])) {
            $value = isset($_POST[$key]) ? $_POST[$key] : $_GET[$key];
            /* EXPRESSION TERNAIRE 
            if (isset($_POST[$key])) {
                return $_POST[$key];
            } else {
                return $_GET[$key];
            }*/
        }

        if (!isset($value)) {
            $value = $default_value;
        }

        if ($typeOfValue == 'integer') {
            return (int) $value;
        }

        return $value;
    }



    /**
     * Method verfNomPrenom
     *
     * @param $valeur $valeur [explicite description]
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
     * Method verfEmail
     *
     * @param $valeur $valeur [explicite description]
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

    /**
     * Method upload
     * Vérifie l'extension du fichier uploadé
     * @param $type $type [explicite description]
     * @param $user $user [explicite description]
     *
     * @return void
     */
    public function upload($media)
    {
        $nomFichier = $_FILES[$media]["name"]; //1822636_1920.pdf
        $extension = explode(".", $nomFichier); // tranforme la chaine de caractere en tableau array()
        $target = "uploads/" . basename($nomFichier);

        $extension = end($extension); // je recupere la dernière donnée du tableau 
        $fichierTmp = $_FILES[$media]["tmp_name"];

        if (move_uploaded_file($fichierTmp, $target)) {
            chmod("uploads/" . $nomFichier, 0777);
            return $target;
        }
    }
}
