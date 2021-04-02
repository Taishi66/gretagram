<?php
class CommentaireModel
{

    function showAllCom($id_article)
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

    function postCom($id_article, $id_compte, $contenu_com = null)
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
}
