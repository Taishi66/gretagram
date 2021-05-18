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
        if (preg_match("#^[a-z0-9._-]{2,50}+@[a-z0-9._-]{2,50}\.[a-z]{2,5}$#", $valeur)) {
            return $valeur; // true
        } else {
            return false;
        }
    }
}
