<?php

class ArticlesModel
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
    function getArticle($id_article)
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
     * @param  date $date_art
     * @param  int $id_compte
     * @return void
     */
    function createArticle($media, $titre, $contenu, $date_art, $id_compte)
    {
        $bdd = Bdd::Connexion();

        $sql = 'INSERT INTO article (media,titre,contenu,date_art, id_compte )
                VALUE (:media,:titre,:contenu, :date_art, :id_compte)';
        $article = $bdd->prepare($sql);
        $resultat = $article->execute([
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":date_art" => $date_art,
            ":id_compte" => $id_compte
        ]);
        $bdd = null;
        return $resultat;
    }




    /**
     * modifierArticle
     *
     * @param  int $id_article
     * @param  mixed $media
     * @param  mixed $titre
     * @param  mixed $contenu
     * @param  date $date_art
     * @param  int $id_compte
     * @return void
     */
    function setArticle($id_article, $media, $titre, $contenu, $date_art, $id_compte)
    {
        $bdd = Bdd::Connexion();

        $sql = 'UPDATE article
                SET media = :media, 
                    titre = :titre, 
                    contenu =:contenu, 
                    date_art =:date_art
                WHERE id_article =:id_article';
        $article = $bdd->prepare($sql);

        $resultat = $article->execute([
            ":id_article" => $id_article,
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":date_art" => $date_art,
            ":id_compte" => $id_compte
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

    /**
     * Method lastArticles
     *
     * @return void
     */
    function lastArticles()
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->query('SELECT * FROM article 
                            ORDER BY id_article DESC');
        $article = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $article;
    }
}
