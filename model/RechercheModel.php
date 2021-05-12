<?php

class RechercheModel
{

    public function __construct()
    {
    }


    public function research($q)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM compte WHERE pseudo LIKE :q');
        $sql->execute([":q" => "%" . $q . "%"]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }

    public function explore($e)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM compte
                            INNER JOIN article ON article.id_compte = compte.id_compte
                            INNER JOIN commentaire ON commentaire.id_article = article.id_article
                            WHERE hashtag_art LIKE :e');
        $sql->execute([":e" => "%" . $e . "%"]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }
}
