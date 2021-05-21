<?php

class PokeService
{

    private $url;

    public function __construct()
    {
        $random = random_int(1, 150);
        $this->url = $_ENV['POKEMON'] . $random;
    }

    public function attack()
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true, //retourne contenu de l'url sous chaîne de caractère
                CURLOPT_TIMEOUT => 0, //temps d'execution de la fonction url en seconde. 0 = infinie
                CURLOPT_MAXREDIRS => 10, //nombre max de redirections http à suivre, à utiliser avec followlocation. 20 par défaut, -1 pour infinie et 0 pour refuser
                CURLOPT_FOLLOWLOCATION => true, //autorise la redireection sur toute les entête "Location:" que le serveurs envoie dans les entêtes HTTP
                CURLOPT_CUSTOMREQUEST => 'GET', //type de requête
            ]
        );
        $data = curl_exec($curl);

        if ($data === false) {
            var_dump(curl_error($curl));
        } else {
            $pikapika = json_decode($data, true); //true pour renvoyer sous forme de tableau associatif
            return $pikapika["sprites"]["front_default"];
        }
        curl_close($curl);
    }
}
