<?php
class Verification
{

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
        if(filter_var($valeur, FILTER_VALIDATE_EMAIL)){
            return $valeur; // true
        } else {
            return false;
        }
    }
}
