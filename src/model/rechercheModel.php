<?php

class RechercheModel
{
    private $bdd = null;

    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }


    /**
     * Méthode de recherche pour trouver les comptes correspondants
     *
     * @param $q $q [explicite description]
     */
    public function research($q)
    {
        $sql = $this->bdd->prepare('SELECT * FROM compte WHERE pseudo LIKE :q');
        $sql->execute([":q" => "%" . $q . "%"]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function researchInbox($query)
    {
        $sql = $this->bdd->prepare('SELECT DISTINCT pseudo FROM compte WHERE pseudo LIKE :q');
        $sql->execute([":q" => "%" . $query . "%"]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
