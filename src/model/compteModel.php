<?php

class CompteModel
{
    private $bdd = null;

    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }
    /**
     * Récupérer un compte à partir d'un article
     *
     * @param $id_article
     */
    public function getCompteFromArticle($id_article)
    {
        $sql = 'SELECT * FROM compte 
                INNER JOIN article ON article.id_compte=compte.id_compte
                WHERE id_article = :id_article';
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute([
            ':id_article' => $id_article
        ]);
        $compte = $resultat->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }

    /**
     * Créer un nouveau compte
     *
     * @param  string $id
     * @param  string $photo
     * @param  string $pseudo
     * @param  string $description_compte
     */
    public function creAccount($id, $photo, $pseudo, $description_compte)
    {
        $sql = 'INSERT INTO compte(pseudo, description_compte, photo, id_user, publications)
                VALUES (:pseudo,:description_compte,:photo, :id, 0)';
        $profil = $this->bdd->prepare($sql);

        $resultat = $profil->execute([
            ":pseudo" => $pseudo,
            ":description_compte" => $description_compte,
            ":photo" => $photo,
            ":id" => $id
        ]);
        return $resultat;
    }

    /**
     * Récupérer un compte à partir de l'id du user connecté
     *
     * @param $id_user
     */
    public function getCompteFromUser($id_user)
    {
        $sql = 'SELECT * FROM compte WHERE id_user = :id_user';
        $compte = $this->bdd->prepare($sql);
        $compte->execute([':id_user' => $id_user]);

        return $compte->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un compte en particulier
     *
     * @param $id_compte
     */
    public function getCompte($id_compte)
    {
        $sql = 'SELECT * FROM compte WHERE id_compte = :id_compte';
        $compte = $this->bdd->prepare($sql);
        $compte->execute([':id_compte' => $id_compte]);

        return $compte->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Récupérer les articles d'un compte
     *
     * @param $id_compte
     */
    public function getArticles($id_compte)
    {
        $sql = 'SELECT * FROM article WHERE article.id_compte = :id_compte';
        $articles = $this->bdd->prepare($sql);
        $articles->execute([':id_compte' => $id_compte]);

        return $articles->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Augmenter le nombre de publication d'un compte
     *
     * @param $id_compte $id_compte [explicite description]
     */
    public function incrementerPublications($id_compte)
    {
        $sql = $this->bdd->prepare('UPDATE compte 
                    SET publications= publications + 1
                    WHERE id_compte =:id_compte');
        $resultat = $sql->execute([':id_compte' => $id_compte]);

        return $resultat;
    }

    /**
     * Diminuer le nombre de publication d'un compte
     *
     * @param $id_compte $id_compte [explicite description]
     */
    public function decrementerPublications($id_compte)
    {
        $sql = $this->bdd->prepare('UPDATE compte
                                SET publications = publications -1
                                WHERE id_compte=:id_compte');

        return $sql->execute([':id_compte' => $id_compte]);
    }


    /**
     * Modifier son compte
     *
     * @param $pseudo $pseudo [explicite description]
     * @param $photo $photo [explicite description]
     * @param $description_compte $description_compte [explicite description]
     * @param $id_compte $id_compte [explicite description]
     *
     */
    public function setCompte($pseudo = null, $photo = null, $description_compte = null, $id_compte)
    {
        $sql = $this->bdd->prepare('UPDATE compte 
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
        return $compte;
    }

    /**
     * Récupérer tout les commentaires d'un compte
     *
     * @param $id_compte
     */
    public function getAllComFromCompte($id_compte)
    {
        $sql = $this->bdd->prepare('SELECT * FROM commentaire
                            INNER JOIN compte ON compte.id_compte = commentaire.id_compte
                            WHERE compte.id_compte = :id_compte');
        $sql->execute([':id_compte' => $id_compte]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Effacer son compte
     *
     * @param $id_compte
     */
    public function deleteCompte($id_compte)
    {
        $sql = $this->bdd->prepare('DELETE FROM compte WHERE id_compte =:id_compte');
        $resultat = $sql->execute([':id_compte' => $id_compte]);
        return $resultat;
    }

    /**
     * Afficher un profil
     *
     * @param $id_compte $id_compte [explicite description]
     */
    public function showProfil($id_compte)
    {
        $sql = $this->bdd->prepare('SELECT * FROM compte 
                            INNER JOIN article ON article.id_compte = compte.id_compte
                            WHERE compte.id_compte = :id_compte');
        $sql->execute([':id_compte' => $id_compte]);
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Suggestion des comptes dans la page HOME
     */
    public function accountSuggestion()
    {
        $sql = $this->bdd->query('SELECT * FROM compte ORDER BY RAND() LIMIT 3');
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Affichage de tout les comptes dans EXPLORE
     *
     */
    public function seeAllAccounts()
    {
        $sql = $this->bdd->query('SELECT * FROM compte');
        $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}
