<?php

class CompteModel
{

    /**
     * @var int $id_user
     */
    function getCompteFromUser($id_user)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte WHERE id_user = :id_user';
        $compte = $bdd->prepare($sql);
        $compte->execute([':id_user' => $id_user]);
        return $compte->fetch(PDO::FETCH_ASSOC);
    }

    function getCompte($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte WHERE id_compte = :id_compte';
        $compte = $bdd->prepare($sql);
        $compte->execute([':id_compte' => $id_compte]);
        return $compte->fetch(PDO::FETCH_ASSOC);
    }


    function getArticles($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM article WHERE article.id_compte = :id_compte';
        $articles = $bdd->prepare($sql);
        $articles->execute([':id_compte' => $id_compte]);
        return $articles->fetchAll(PDO::FETCH_ASSOC);
    }

    function incrementerPublications($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE compte 
                    SET publications= publications + 1
                    WHERE id_compte =:id_compte');
        $resultat = $sql->execute([':id_compte' => $id_compte]);
        return $resultat;
    }

    function decrementerPublications($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE compte
                                SET publications =-1
                                WHERE id_compte=:id_compte');
        return $sql->execute([':id_compte' => $id_compte]);
    }

    /* function getCompteAll($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte 
            LEFT JOIN article ON compte.id_compte = article.id_compte
            WHERE compte.id_compte = :id_compte';
        $compte = $bdd->prepare($sql);
        $compte->execute([':id_compte' => $id_compte]);
        return $compte->fetchAll(PDO::FETCH_ASSOC);
    } */
}
