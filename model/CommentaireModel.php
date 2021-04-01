<?php
class CommentaireModel
{


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
