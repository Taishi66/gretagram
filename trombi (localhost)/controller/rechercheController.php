<?php
include("model/rechercheModel.php");

class RechercheController extends RechercheModel
{
    public function AfficheChercher($q = null)
    {
        if ($q !== null) {
            $recherche = $this->listeRecherche($q);
            include("view/recherche/viewRecherche.php");
        } else {
            include("view/404.php");
        }
    }
}
