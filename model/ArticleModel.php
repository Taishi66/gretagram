<?php

class ArticleModel
{

    function getAllArticles($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM article WHERE article.id_compte = :id_compte';
        $articles = $bdd->prepare($sql);
        $articles->execute([':id_compte' => $id_compte]);
        $resultat = $articles->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultat);
        return $resultat;
    }

    /**
     * voirArticle
     *
     * @param  int $id_article
     * @return void
     */
    function getArticleModel($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM article 
                WHERE id_article =:id_article';
        $article = $bdd->prepare($sql);
        $article->execute([
            ":id_article" => $id_article
        ]);
        $resultat = $article->fetch(PDO::FETCH_ASSOC);

        $bdd = null;
        return $resultat;
    }

    /**
     * cr
     *
     * @param  int $media
     * @param  mixed $titre
     * @param  mixed $contenu
     * @param  int $id_compte
     * @return void
     */
    function createArticle($media, $titre, $contenu, $id_compte)
    {
        $bdd = Bdd::Connexion();

        $sql = 'INSERT INTO article (media,titre,contenu,id_compte )
                VALUES (:media,:titre,:contenu, :id_compte)';
        $article = $bdd->prepare($sql);
        $resultat = $article->execute([
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":id_compte" => $id_compte
        ]);
        $bdd = null;
        return $resultat;
    }

    /**
     * setArticle
     *
     * @param  int $id_article
     * @param  mixed $media
     * @param  mixed $titre
     * @param  mixed $contenu
     * @param  int $id_compte
     * @return void
     */
    function setArticleModel($media, $titre, $contenu, $id_article)
    {
        $bdd = Bdd::Connexion();

        $sql = 'UPDATE article
                SET media = :media, 
                    titre = :titre, 
                    contenu =:contenu 
                WHERE id_article =:id_article';
        $article = $bdd->prepare($sql);

        $resultat = $article->execute([
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":id_article" => $id_article
        ]);

        $bdd = null;
        return $resultat;
    }

    /**
     * deleteArticle
     *
     * @param  int $id_article
     * @return void
     */
    function deleteArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = 'DELETE FROM article
                WHERE id_article = :id_article';
        $article = $bdd->prepare($sql);
        $resultat = $article->execute([
            ":id_article" => $id_article
        ]);
        $bdd = null;
        return $resultat;
    }

    function deleteAllArticles($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'DELETE FROM article
                WHERE id_compte = :id_compte';
        $article = $bdd->prepare($sql);
        $resultat = $article->execute([
            ":id_compte" => $id_compte
        ]);
        $bdd = null;
        return $resultat;
    }

    /**
     * Method lastArticles
     *
     * @return void
     */
    function lastArticles()
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->query('SELECT * FROM article 
                            INNER JOIN compte ON compte.id_compte = article.id_compte
                            GROUP BY article.id_article 
                            ORDER BY article.id_article DESC');
        $articles = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $articles;
    }

    function showArticlesByLikes()
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM articles ORDER BY likes DESC');
        $articles = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $articles;
    }
}
