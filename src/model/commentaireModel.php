<?php

class CommentaireModel
{
    private $bdd = null;

    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }
    /**
     * Renvoie tout les commentaires de la BDD
     */
    public function toutLesCommentairesBDD()
    {
        $sql = $this->bdd->query('SELECT * FROM commentaire');
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id_article
     *
     * @return Tout les commentaires d'un article
     */
    public function showAllComFromArticle($id_article)
    {
        $sql = $this->bdd->prepare('SELECT * FROM commentaire 
                            INNER JOIN compte ON compte.id_compte = commentaire.id_compte
                            WHERE id_article =:id_article
                            ORDER BY id_com DESC');
        $sql->execute([':id_article' => $id_article]);
        $commentaire = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $commentaire;
    }

    /**
     * Renvoie le dernier commentaire d'un article
     *
     * @param $id_article
     */
    public function getLastComFromArticle($id_article)
    {
        $sql = $this->bdd->prepare('SELECT * FROM commentaire 
                            WHERE id_article =:id_article
                            ORDER BY id_com DESC LIMIT 1');
        $sql->execute([':id_article' => $id_article]);
        $commentaire = $sql->fetch(PDO::FETCH_ASSOC);
        return $commentaire;
    }

    /**
     * Méthode pour poster un commentaire
     *
     * @param $id_article
     * @param $id_compte
     * @param $contenu_com
     *
     */
    public function postCom($id_article, $id_compte, $contenu_com = null, $date_com = null)
    {
        $sql = $this->bdd->prepare('INSERT INTO commentaire(id_article,id_compte,contenu_com)
                            VALUE (:id_article,:id_compte,:contenu_com)');
        $com = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte,
            ':contenu_com' => $contenu_com
        ]);
        return $com;
    }

    /**
     * Method pour effacer un commentaire
     *
     * @param $id_com
     */
    public function deleteCom($id_com)
    {
        $sql = 'DELETE FROM commentaire WHERE id_com = :id_com';
        $commentaire = $this->bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_com" => $id_com
        ]);
        return $resultat;;
    }

    /**
     * Methode effacer tous les commentaires d'un article
     *
     * @param $id_article
     */
    public function deleteComAllFromArticle($id_article)
    {
        $sql = 'DELETE FROM commentaire WHERE id_article = :id_article';
        $commentaire = $this->bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_article" => $id_article
        ]);
        return $resultat;;
    }



    /**
     * Effacer tous les commentaires postés par un compte
     *
     * @param $id_compte $id_compte [explicite description]
     */
    public function deleteAllComFromCompte($id_compte)
    {
        $sql = 'DELETE FROM commentaire WHERE id_compte = :id_compte';
        $commentaire = $this->bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_compte" => $id_compte
        ]);
        return $resultat;;
    }

    /**
     * Récupérer un commentaire
     *
     * @param $id_com
     */
    public function getCommentaire($id_com)
    {
        $sql = $this->bdd->prepare('SELECT * FROM commentaire WHERE id_com =:id_com');
        $sql->execute([':id_com' => $id_com]);
        $resultat = $sql->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Récupérer le nombre de commentaire d'un article
     *
     * @param $id_article
     */
    public function getNbComFromArticle($id_article)
    {
        $sql = $this->bdd->prepare('SELECT id_com FROM commentaire WHERE id_article = :id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        return $sql->rowcount();
    }
}
