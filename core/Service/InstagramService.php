<?php

class InstagramService
{
    private $url = 'https://graph.instagram.com/';

    public function getMedias()
    {
        $params = 'me/media?fields=id,caption,media_type,media_url,username,timestamp';
        $access_token = '&access_token=' . $_ENV['T_INSTAGRAM'];

        $url = $this->url . $params . $access_token;
        $curl = curl_init(); //Initialise la session CURL

        curl_setopt_array($curl, array( //Définit les options de transfert
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));


        $response = curl_exec($curl); //Execute la session

        curl_close($curl); //Met fin à la session
        return json_decode($response, true);
    }
}
