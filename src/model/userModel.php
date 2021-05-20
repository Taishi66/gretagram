<?php

class UserModel
{
    private $bdd = null;

    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }
    /**
     * Method pour récupérer tout les users de la BDD
     */
    public function getAllUsers()
    {
        return $this->bdd->query('SELECT * FROM user')->fetchAll();
    }

    /**
     * Method renvoie les datas des tables users et leur compte par id_user envoyée
     *
     * @param $id_user $id_user [explicite description]
     *
     * @return array of tables user & compte by id_user
     */
    public function getUser($id_user)
    {
        $profil = $this->bdd->prepare('SELECT * FROM compte 
                                    INNER JOIN user ON compte.id_user = user.id_user
                                    INNER JOIN article ON compte.id_compte = article.id_compte
                                    WHERE compte.id_user=:id_user');
        $profil->execute([":id_user" => $id_user]);
        return $profil->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * inscription crée un nouvel user en BDD
     *
     * @param  string $nom
     * @param  string $prenom
     * @param  string $email
     * @param  string $mdp
     */
    public function inscription($nom, $prenom, $email, $mdp)
    {
        $sql = 'INSERT INTO user(nom,prenom,email,mdp) 
                VALUES (:nom,:prenom,:email,:mdp)';
        $profil = $this->bdd->prepare($sql);
        return $profil->execute([
            ":nom" => $nom, ":prenom" => $prenom,
            ":email" => $email, ":mdp" => $mdp
        ]);
    }


    /**
     * login se connecter à son compte
     *
     * @param  mixed $email
     */
    public function login($email)
    {
        $profil = $this->bdd->prepare('SELECT * FROM user WHERE email=:email');
        $profil->execute([":email" => $email]);
        return $profil->fetch();
    }


    /**
     * Method pour effacer un user
     *
     * @param $id_user
     *
     */
    public function deleteUser($id_user)
    {
        $sql = $this->bdd->prepare('DELETE FROM user WHERE id_user = :id_user');
        return $sql->execute([':id_user' => $id_user]);
    }
}
