<?php

class CompteModel
{


    function getCompteFromArticle($id_article)
    {

        $bdd = Bdd::Connexion();
        $sql = 'SELECT * FROM compte 
                INNER JOIN article ON article.id_compte=compte.id_compte
                WHERE id_article = :id_article';
        $resultat = $bdd->prepare($sql);
        $resultat->execute([
            ':id_article' => $id_article
        ]);
        $compte = $resultat->fetch(PDO::FETCH_ASSOC);
        $bdd = null;
        return $compte;
    }

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
                                SET publications = publications -1
                                WHERE id_compte=:id_compte');
        $bdd = null;

        return $sql->execute([':id_compte' => $id_compte]);
    }


    /**
     * Method setCompteModel
     *
     * @param $pseudo $pseudo [explicite description]
     * @param $photo $photo [explicite description]
     * @param $description_compte $description_compte [explicite description]
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
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

    /**
     * Method getAllComFromCompte
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function getAllComFromCompte($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM commentaire
                            INNER JOIN compte ON compte.id_compte = commentaire.id_compte
                            WHERE compte.id_compte = :id_compte');
        $sql->execute([':id_compte' => $id_compte]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }

    /**
     * Method deleteCompte
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    function deleteCompte($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM compte WHERE id_compte =:id_compte');
        $resultat = $sql->execute([':id_compte' => $id_compte]);
        $bdd = null;
        return $resultat;
    }

    function showProfil($id_compte)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('SELECT * FROM compte 
                            INNER JOIN article ON article.id_compte = compte.id_compte
                            WHERE compte.id_compte = :id_compte');
        $sql->execute([':id_compte' => $id_compte]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
    }

    function accountSuggestion()
    {
        $bdd = Bdd::connexion();
        $sql = $bdd->query('SELECT * FROM compte ORDER BY RAND() LIMIT 3');
        $bdd = null;
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function seeAllAccounts()
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->query('SELECT * FROM compte');
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        $bdd = null;
        return $resultat;
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
