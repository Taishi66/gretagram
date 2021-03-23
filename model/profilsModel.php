<?php

class ProfilsModel
{


    /**
     * listeProfils
     *
     * @return void
     */
    public function listeProfils()
    {
        $bdd = Bdd::Connexion();
        $resultat = $bdd->query('SELECT * FROM user')->fetchAll();
        $bdd = null;
        return $resultat;
    }


    /**
     * Profil
     *
     * @param  int $id_user
     * @return void
     */
    public function Profil($id_user)
    {
        $bdd = Bdd::Connexion();
        $profil = $bdd->prepare('SELECT * FROM compte 
                                    INNER JOIN user ON compte.id_user = user.id_user
                                    WHERE compte.id_user=:id_user');
        $profil->execute([":id_user" => $id_user]);
        //var_dump($profil->fetchAll()); //test
        $resultat = $profil->fetch(PDO::FETCH_ASSOC);

        $bdd = null;

        return $resultat;
    }


    /**
     * inscription
     *
     * @param  string $nom
     * @param  string $prenom
     * @param  string $email
     * @param  string $mdp
     * @return void
     */
    public function inscription($nom, $prenom, $email, $mdp)
    {
        $bdd = Bdd::Connexion();
        $sql = 'INSERT INTO user(nom,prenom,email,mdp) 
                VALUES (:nom,:prenom,:email,:mdp)';
        $profil = $bdd->prepare($sql);
        $resultat = $profil->execute([
            ":nom" => $nom, ":prenom" => $prenom,
            ":email" => $email, ":mdp" => $mdp
        ]);
        $bdd = null;

        return $resultat;
    }


    /**
     * login
     *
     * @param  mixed $email
     * @return void
     */
    public function login($email)
    {
        $bdd = Bdd::Connexion();
        $profil = $bdd->prepare('SELECT * FROM user WHERE email=:email');
        $profil->execute([":email" => $email]);
        $resultat = $profil->fetch();
        $bdd = null;
        return $resultat;
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
        $sql = 'INSERT INTO compte(pseudo, description_compte, photo, id_user)
                VALUES (:pseudo,:description_compte,:photo, :id)';
        $profil = $bdd->prepare($sql);
        var_dump($id, $photo, $pseudo, $description_compte);

        $resultat = $profil->execute([
            ":pseudo" => $pseudo,
            ":description_compte" => $description_compte,
            ":photo" => $photo,
            ":id" => $id
        ]);
        $bdd = null;
        return $resultat;
    }
}
