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
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_MAXREDIRS => 10, //permet de rediriger le transfert en cas de changement d'adresse d'API
                CURLOPT_FOLLOWLOCATION => true, //autorise la redirection,
                CURLOPT_CUSTOMREQUEST => 'GET', //type de requête
            ]
        );
        $data = curl_exec($curl);

        if ($data === false) {
            var_dump(curl_error($curl));
        } else {
            $pikapika = json_decode($data, true);
            return $pikapika["forms"][0]["url"];
        }
        curl_close($curl);
    }
}
