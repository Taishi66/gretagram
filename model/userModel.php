<?php

class UserModel
{



    /**
     * Method getAllUsers
     *
     * @return array of users
     */
    public function getAllUsers()
    {
        $bdd = Bdd::Connexion();
        $resultat = $bdd->query('SELECT * FROM user')->fetchAll();
        $bdd = null;
        return $resultat;
    }



    /**
     * Method getUser
     *
     * @param $id_user $id_user [explicite description]
     *
     * @return array of tables user & compte by id_user
     */
    public function getUser($id_user)
    {
        $bdd = Bdd::Connexion();
        $profil = $bdd->prepare('SELECT * FROM compte 
                                    INNER JOIN user ON compte.id_user = user.id_user
                                    INNER JOIN article ON compte.id_compte = article.id_compte
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

    public function deleteUser($id_user)
    {
        $bdd = Bdd::Connexion();
        $sql = $bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
        $user = $sql->execute([':id_user' => $id_user]);
        $bdd = null;
        return $user;
    }
}
