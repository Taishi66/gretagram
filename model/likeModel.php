<?php

class LikeModel
{

    function supprimeLike($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes WHERE id_article = :id_article');
        $resultat = $sql->execute([
            ':id_article' => $id_article
        ]);
        $bdd = null;
        return $resultat;
    }

    function supprimeAllLike($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes WHERE id_compte = :id_compte');
        $resultat = $sql->execute([
            ':id_compte' => $id_compte
        ]);
        $bdd = null;
        return $resultat;
    }

    function ajouterLike($id_article, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('INSERT INTO likes (id_article, id_compte)
                                VALUE (:id_article, :id_compte)');
        $resultat = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte
        ]);
        $bdd = null;
        return $resultat;
    }

    function ajouterLikeArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE article 
                    SET likes= likes + 1
                    WHERE id_article =:id_article');
        $resultat = $sql->execute([
            ':id_article' => $id_article
        ]);
        $bdd = null;
        return $resultat;
    }

    function enleverLike($id_article, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM likes
                            WHERE id_article=:id_article AND id_compte=:id_compte');
        $resultat = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte
        ]);
        $bdd = null;
        return $resultat;;
    }

    function enleverLikeArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE article 
                    SET likes = likes - 1
                    WHERE id_article =:id_article');
        $resultat = $sql->execute([
            ':id_article' => $id_article
        ]);
        $bdd = null;
        return $resultat;
    }

    function getLikeForArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM likes WHERE id_article =:id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }

    function getNbLikeForArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT id_like FROM likes WHERE id_article =:id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        return $sql->rowCount();
    }

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
