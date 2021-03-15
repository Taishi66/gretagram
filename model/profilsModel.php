<?php

class ProfilsModel
{
    public $nom;
    public $prenom;
    public $email;
    public $mdp;



    public function listeProfils()
    {
        $bdd = Bdd::Connexion();
        $resultat = $bdd->query('SELECT * FROM user')->fetchAll();
        $bdd = null;
        return $resultat;
    }
    public function Profil($id_user)
    {
        $bdd = Bdd::Connexion();
        $profil = $bdd->prepare('SELECT * FROM compte 
                                    INNER JOIN user ON compte.id_user = user.id_user
                                    WHERE compte.id_user=:id_user');
        $profil->execute([":id_user" => $id_user]);
        var_dump($profil->fetchAll()); //test
        $resultat = $profil->fetchAll();

        $bdd = null;

        return $resultat;
    }

    public function inscription()
    {
        $bdd = Bdd::Connexion();
        $sql = 'INSERT INTO user(nom,prenom,email,mdp) 
                VALUES (:nom,:prenom,:email,:mdp)';
        $profil = $bdd->prepare($sql);
        $resultat = $profil->execute([
            ":nom" => $this->nom, ":prenom" => $this->prenom,
            ":email" => $this->email, ":mdp" => $this->mdp
        ]);
        $bdd = null;

        return $resultat;
    }
    //Connexion user
    public function login()
    {
        $bdd = Bdd::Connexion();
        $profil = $bdd->prepare('SELECT * FROM user WHERE email=:email');
        $profil->execute([":email" => $this->email]);
        $resultat = $profil->fetch();
        $bdd = null;
        return $resultat;
    }

    public function creAccount($id)
    {
        $bdd = Bdd::Connexion();
        $sql = 'INSERT INTO compte(pseudo, description_compte, photo, id_user)
                VALUES (:pseudo,:description_compte,:photo,:id_user)';
        $profil = $bdd->prepare($sql);
        $resultat = $profil->execute([
            ":pseudo" => $this->pseudo,
            ":description_compte" => $this->description_compte,
            ":photo" => $this->photo,
            ":id_user" => $id
        ]);
        $bdd = null;
        return $resultat;
    }
}
