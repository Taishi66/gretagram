<?php

class CompteModel
{

    /**
     * creAccount
     *
     * @param  string $id
     * @param  string $photo
     * @param  string $pseudo
     * @param  string $description_compte
     * @return void
     */
    public function creAccount($id, $photo, $pseudo, $description_compte)
    {
        //$id_user ='SELECT id_user FROM user WHERE id_user = LAST_INSERT_ID()';
        $bdd = Bdd::Connexion();
        $sql = 'INSERT INTO compte(pseudo, description_compte, photo, id_user, publications)
                VALUES (:pseudo,:description_compte,:photo, :id, 0)';
        $profil = $bdd->prepare($sql);

        $resultat = $profil->execute([
            ":pseudo" => $pseudo,
            ":description_compte" => $description_compte,
            ":photo" => $photo,
            ":id" => $id
        ]);
        $bdd = null;
        return $resultat;
    }

    /**
     * @var int $id_user
     */
    /**
     * Method getCompteFromUser
     *
     * @param $id_user $id_user [explicite description]
     *
     * @return void
     */
    function getCompteFromUser($id_user)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte WHERE id_user = :id_user';
        $compte = $bdd->prepare($sql);
        $compte->execute([':id_user' => $id_user]);
        $bdd = null;

        return $compte->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Method getCompte
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function getCompte($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte WHERE id_compte = :id_compte';
        $compte = $bdd->prepare($sql);
        $compte->execute([':id_compte' => $id_compte]);
        $bdd = null;

        return $compte->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Method getArticles
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function getArticles($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM article WHERE article.id_compte = :id_compte';
        $articles = $bdd->prepare($sql);
        $articles->execute([':id_compte' => $id_compte]);
        $bdd = null;

        return $articles->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Method incrementerPublications
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function incrementerPublications($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE compte 
                    SET publications= publications + 1
                    WHERE id_compte =:id_compte');
        $resultat = $sql->execute([':id_compte' => $id_compte]);
        $bdd = null;

        return $resultat;
    }

    /**
     * Method decrementerPublications
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function decrementerPublications($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE compte
                                SET publications =-1
                                WHERE id_compte=:id_compte');
        $bdd = null;

        return $sql->execute([':id_compte' => $id_compte]);
    }


    function setCompteModel($pseudo = null, $photo = null, $description_compte = null, $id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('UPDATE compte 
                SET pseudo =:pseudo,
                photo =:photo,
                description_compte =:description_compte
                WHERE id_compte =:id_compte');
        $compte = $sql->execute([
            ':pseudo' => $pseudo,
            ':photo' => $photo,
            ':description_compte' => $description_compte,
            ':id_compte' => $id_compte
        ]);
        $bdd = null;
        return $compte;
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
