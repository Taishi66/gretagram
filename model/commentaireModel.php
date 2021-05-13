<?php
class CommentaireModel
{


    /**
     * Renvoie tout les commentaires de la BDD
     */
    function toutLesCommentairesBDD()
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->query('SELECT * FROM commentaire');
        $bdd = null;
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id_article 
     *
     * @return Tout les commentaires d'un article 
     */
    function showAllComFromArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM commentaire 
                            INNER JOIN compte ON compte.id_compte = commentaire.id_compte
                            WHERE id_article =:id_article
                            ORDER BY id_com DESC');
        $sql->execute([':id_article' => $id_article]);
        $commentaire = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $commentaire;
    }

    /**
     * Renvoie le dernier commentaire d'un article 
     *
     * @param $id_article 
     */
    function getLastComFromArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM commentaire 
                            WHERE id_article =:id_article
                            ORDER BY id_com DESC LIMIT 1');
        $sql->execute([':id_article' => $id_article]);
        $commentaire = $sql->fetch(PDO::FETCH_ASSOC);
        $bdd = null;
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
    function postCom($id_article, $id_compte, $contenu_com = null, $date_com = null)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('INSERT INTO commentaire(id_article,id_compte,contenu_com)
                            VALUE (:id_article,:id_compte,:contenu_com)');
        $com = $sql->execute([
            ':id_article' => $id_article,
            ':id_compte' => $id_compte,
            ':contenu_com' => $contenu_com
        ]);
        $bdd = null;
        return $com;
    }

    /**
     * Method pour effacer un commentaire
     *
     * @param $id_com 
     */
    function deleteCom($id_com)
    {
        $bdd = Bdd::Connexion();
        $sql = 'DELETE FROM commentaire WHERE id_com = :id_com';
        $commentaire = $bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_com" => $id_com
        ]);
        $bdd = null;
        return $resultat;;
    }

    /**
     * Methode effacer tous les commentaires d'un article
     *
     * @param $id_article 
     */
    function deleteComAllFromArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = 'DELETE FROM commentaire WHERE id_article = :id_article';
        $commentaire = $bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_article" => $id_article
        ]);
        $bdd = null;
        return $resultat;;
    }



    /**
     * Effacer tous les commentaires postés par un compte
     * 
     * @param $id_compte $id_compte [explicite description]
     */
    function deleteAllComFromCompte($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'DELETE FROM commentaire WHERE id_compte = :id_compte';
        $commentaire = $bdd->prepare($sql);
        $resultat = $commentaire->execute([
            ":id_compte" => $id_compte
        ]);
        $bdd = null;
        return $resultat;;
    }

    /**
     * Récupérer un commentaire
     *
     * @param $id_com
     */
    function getCommentaire($id_com)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM commentaire WHERE id_com =:id_com');
        $sql->execute([':id_com' => $id_com]);
        $resultat = $sql->fetch(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }

    /**
     * Récupérer le nombre de commentaire d'un article
     *
     * @param $id_article 
     */
    function getNbComFromArticle($id_article)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT id_com FROM commentaire WHERE id_article = :id_article');
        $sql->execute([
            ':id_article' => $id_article
        ]);
        $bdd = null;
        return $sql->rowcount();
    }
}
