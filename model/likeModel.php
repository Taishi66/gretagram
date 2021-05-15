<?php

class LikeModel
{

    /**
     * Method pour supprimer un like
     *
     * @param $id_article 
     */
    function supprimeLike($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes WHERE id_article = :id_article');
        $resultat = $sql->execute([
            ':id_article' => $id_article
        ]);
        return $resultat;
    }

    /**
     * Supprimer tout les likes d'un compte
     *
     * @param $id_compte 
     */
    function supprimeAllLike($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes WHERE id_compte = :id_compte');
        $resultat = $sql->execute([
            ':id_compte' => $id_compte
        ]);
        return $resultat;
    }

    /**
     * Method ajouter un like 
     *
     * @param $id_article
     * @param $id_compte 
     */
    function ajouterLike($id_article, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('INSERT INTO likes (id_article, id_compte)
                                VALUE (:id_article, :id_compte)');
        $resultat = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte
        ]);
        return $resultat;
    }


    /**
     * Method enlever un Like
     *
     * @param $id_article 
     * @param $id_compte 
     */
    function enleverLike($id_article, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes
                            WHERE id_article=:id_article AND id_compte=:id_compte');
        $resultat = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte
        ]);
        return $resultat;;
    }


    /**
     * Récupérer un like pour un article
     *      *
     * @param $id_article 
     */
    function getLikeForArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM likes WHERE id_article =:id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Récupérer le nombre de like
     *
     * @param $id_article 
     */
    function getNbLikeForArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT id_like FROM likes WHERE id_article =:id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        return $sql->rowCount();
    }

    /**
     * Récupérer le nombre de like avec l'id du compte et de l'article
     *
     * @param $id_article $id_article [explicite description]
     * @param $id_compte $id_compte [explicite description]
     */
    function getLikeForArticleForCompte($id_article, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM likes WHERE id_article =:id_article AND id_compte=:id_compte');
        $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte
        ]);
        return $sql->rowCount();
    }
}
