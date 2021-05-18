<?php
include("bdd.php");


class Model
{



    function add($sexe = null, $nom = null, $prenom = null, $description = null, $ville = null, $email = null, $mdp = null)
    {

        $bdd = Bdd::Connexion();
        $sql = 'INSERT INTO utilisateur(sexe,nom,prenom,description,ville,email,mdp)
            VALUES(:sexe, :nom,:prenom,:description,:ville,:email,:mdp)';
        $user = $bdd->prepare($sql);
        $newUser = $user->execute([
            ":sexe" => $sexe,
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":description" => $description,
            ":ville" => $ville,
            ":email" => $email,
            ":mdp" => $mdp
        ]);
        return $newUser;
    }
}
