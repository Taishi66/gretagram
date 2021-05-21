<?php

class ChuckService
{
    private $url;

    public function __construct()
    {
        $this->url = $_ENV['CHUCK'];
    }

    public function omegalul()
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true, //autorise la redirection,
                CURLOPT_CUSTOMREQUEST => 'GET', //type de requête
            ]
        );
        $data = curl_exec($curl);

        if ($data === false) {
            var_dump(curl_error($curl));
        } else {
            $lol = json_decode($data, true); //true pour renvoyer sous forme de tableau associatif
            return $lol['value']['joke'];
        }
        curl_close($curl);
    }
}
