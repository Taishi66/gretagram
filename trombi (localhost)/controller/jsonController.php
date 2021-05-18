<?php
include("model/profilsModel.php");

class JsonController extends ProfilsModel
{

    public function AfficheListeProfilsJson()
    {
        $listeProfils = $this->listeProfils(); //model
        return json_encode($listeProfils);
    }
}
