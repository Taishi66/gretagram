<?php

class InstagramService
{
    private $url = 'https://graph.instagram.com/';

    public function getMedias()
    {
        $params = 'me/media?fields=id,caption,media_type,media_url,username,timestamp';
        $access_token = '&access_token=' . $_ENV['T_INSTAGRAM'];

        $url = $this->url . $params . $access_token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));


        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
