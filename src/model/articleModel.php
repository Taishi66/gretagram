<?php

class ArticleModel
{
    private $bdd = null;

    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }

    /**
     * Method qui récupère tout les articles d'un compte avec l'id_compte
     *
     * @param $id_compte
     *
     */
    public function getAllArticles($id_compte)
    {
        $sql = 'SELECT * FROM article WHERE article.id_compte = :id_compte ORDER BY article.id_article DESC';
        $articles = $this->bdd->prepare($sql);
        $articles->execute([':id_compte' => $id_compte]);
        $resultat = $articles->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($resultat);
        return $resultat;
    }

    /**
     * Récupère l'article qui correspond à l'id_article envoyé
     *
     * @param  int $id_article
     */
    public function getArticle($id_article)
    {
        $sql = 'SELECT * FROM article 
                WHERE id_article =:id_article';
        $article = $this->bdd->prepare($sql);
        $article->execute([
            ":id_article" => $id_article
        ]);
        $resultat = $article->fetch(PDO::FETCH_ASSOC);

        return $resultat;
    }

    /**
     * créer un article
     *
     * @param  int $media
     * @param  mixed $titre
     * @param  mixed $contenu
     * @param  int $id_compte
     */
    public function createArticle($media, $titre, $contenu, $id_compte)
    {
        $sql = 'INSERT INTO article (media,titre,contenu,id_compte )
                VALUES (:media,:titre,:contenu, :id_compte)';
        $article = $this->bdd->prepare($sql);
        $resultat = $article->execute([
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":id_compte" => $id_compte
        ]);
        return $resultat;
    }

    /**
     * Modifier un article
     *
     * @param  int $id_article
     * @param  mixed $media
     * @param  mixed $titre
     * @param  mixed $contenu
     * @param  int $id_compte
     */
    public function setArticle($media, $titre, $contenu, $id_article)
    {
        $sql = 'UPDATE article
                SET media = :media, 
                    titre = :titre, 
                    contenu =:contenu 
                WHERE id_article =:id_article';
        $article = $this->bdd->prepare($sql);

        $resultat = $article->execute([
            ":media" => $media,
            ":titre" => $titre,
            ":contenu" => $contenu,
            ":id_article" => $id_article
        ]);

        return $resultat;
    }

    /**
     * Effacer un article correspondant à l'id_article envoyé
     *
     * @param  int $id_article
     */
    public function deleteArticle($id_article)
    {
        $sql = 'DELETE FROM article
                WHERE id_article = :id_article';
        $article = $this->bdd->prepare($sql);
        $resultat = $article->execute([
            ":id_article" => $id_article
        ]);
        return $resultat;
    }



    /**
     * Effacer tout les articles d'un compte à partir de l'id_compte
     *
     * @param $id_compte
     *
     */
    public function deleteAllArticles($id_compte)
    {
        $sql = 'DELETE FROM article
                WHERE id_compte = :id_compte';
        $article = $this->bdd->prepare($sql);
        $resultat = $article->execute([
            ":id_compte" => $id_compte
        ]);
        return $resultat;
    }

    /**
     * Renvoie les articles par ordre du plus récent au plus vieux
     */
    public function lastArticles()
    {
        $sql = $this->bdd->query('SELECT * FROM article 
                            INNER JOIN compte ON compte.id_compte = article.id_compte
                            GROUP BY article.id_article 
                            ORDER BY article.id_article DESC');
        $articles = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    /**METHOD NOT USED
     * Renvoie les articles par ordre du + liké au - liké
     *
     */
    public function showArticlesByLikes()
    {
        $sql = $this->bdd->prepare('SELECT * FROM articles ORDER BY likes DESC');
        $articles = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }
}
