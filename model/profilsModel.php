<?php

class ProfilsModel
{
    public function listeProfils()
    {
        $bdd = Bdd::Connexion();
        $resultat = $bdd->query('SELECT * FROM user')->fetchAll();
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
      
}
