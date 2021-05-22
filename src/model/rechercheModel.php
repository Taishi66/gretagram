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

    /**METHOD NOT USED
     * Affiche tout les comptes correspondant au hashtag
     *
     * @param $e $e [explicite description]
     *
     * @return void
     */
    public function explore($e)
    {
        $sql = $this->bdd->prepare('SELECT * FROM compte
                            INNER JOIN article ON article.id_compte = compte.id_compte
                            INNER JOIN commentaire ON commentaire.id_article = article.id_article
                            WHERE hashtag_art LIKE :e');
        $sql->execute([":e" => "%" . $e . "%"]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
