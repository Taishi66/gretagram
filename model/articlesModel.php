<?php

class ArticlesModel
{
    /**
     * voirArticle
     *
     * @param  int $id_article
     * @return void
     */
    function voirArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM article 
            WHERE id_article =:id_article';
        $article = $bdd->prepare($sql);
        $article->execute([
            "id_article" => $id_article
        ]);
        $resultat = $article->fetch();

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
    function créerArticle($media, $titre, $contenu, $date_art, $id_compte)
    {
        $bdd = Bdd::Connexion();

        $sql = 'INSERT INTO article (media,titre,contenu,date_art )
                VALUE (:media,:titre,:contenu, :date_art)';
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
    function modifierArticle($id_article, $media, $titre, $contenu, $date_art, $id_compte)
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
}
