<?php
//include("../bdd.php");
class RechercheModel
{
    private $bdd;

    // execute au meme temps que l'instentiation de la class
    public function __construct()
    {
        $this->bdd = Bdd::Connection();
    }

    // retourn une liste des users
    public function listeRecherche($q)
    {
        $resultat = $this->bdd->prepare('SELECT * FROM users WHERE nom LIKE :q OR prenom LIKE :q');
        $resultat->execute([":q" => "%".$q."%"]);

        // var_dump($resultat->fetchAll()); //test
        return $resultat->fetchAll();
    }

}
/** test 
$test= new RechercheModel();
$test->listeRecherche("by");
*/