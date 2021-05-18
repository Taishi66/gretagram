<?php
//include("../bdd.php"); // test
class ProfilsModel
{
    // execute au meme temps que l'instentiation de la class

    // retourn une liste des users
    public function listeProfils()
    {
        $bdd = Bdd::Connection();
        $resultat = $bdd->query('SELECT * FROM users')->fetchAll();
        // var_dump($resultat); //test
        $bdd = null;
        return $resultat;
    }

    // retourn un user
    public function Profil($id_user)
    {
        $bdd = Bdd::Connection();
        $profil = $bdd->prepare('SELECT * FROM users WHERE id_user=:id_user');
        $profil->execute([":id_user" => $id_user]);
        // var_dump($profil->fetch()); //test
        $resultat = $profil->fetch();

        $bdd = null;

        return $resultat;
    }

    // retourn un les categorie avec le contenus du profil $id_user
    public function ProfilContenusCategories($id_user)
    {
        $bdd = Bdd::Connection();
        $sql = "SELECT contenus.*, categories.nom AS cat 
        FROM contenus 
        INNER JOIN categories ON contenus.id_categorie=categories.id_categorie 
        WHERE contenus.id_user=:id_user";

        $profil = $bdd->prepare($sql);
        $profil->execute([":id_user" => $id_user]);
        $resultat = $profil->fetchAll();

        $bdd = null;
        return $resultat;
    }


    // retourn un user
    public function inscription()
    {
        $bdd = Bdd::Connection();
        $sql = 'INSERT INTO users(nom,prenom,infos,image,email,mdp) 
                VALUES (:nom,:prenom,:infos,:image,:email,:mdp)';
        $profil = $bdd->prepare($sql);
        $resultat = $profil->execute([
            ":nom" => $this->nom, ":prenom" => $this->prenom,
            ":infos" => $this->infos, ":image" => $this->image,
            ":email" => $this->email, ":mdp" => $this->mdp
        ]);
        $bdd = null;
        // var_dump($profil->fetch()); //test
        return $resultat; // true ou false
    }
    //modifier un profil connecté en utilisant un modal
    public function modificationProfil($id)
    {
        $bdd = Bdd::Connection();
        $sql = 'UPDATE users SET nom=:nom,prenom=:prenom,infos=:infos,cv=:cv,
        image=:image,email=:email,mdp=:mdp
        WHERE id_user=:id_user';
        $profil = $bdd->prepare($sql);
        $resultat = $profil->execute([
            ":nom" => $this->nom, ":prenom" => $this->prenom,
            ":infos" => $this->infos, ":cv" => $this->cv, ":image" => $this->image,
            ":email" => $this->email, ":mdp" => $this->mdp,
            ":id_user" => $id
        ]);
        $bdd = null;
        return $resultat;
    }

    //connecter un utilisateur à son compte et modifier son profil
    public function connexion()
    {
        $bdd = Bdd::Connection();
        $profil = $bdd->prepare('SELECT * FROM users WHERE email=:email');
        $profil->execute([":email" => $this->email]);
        $resultat = $profil->fetch();
        $bdd = null;
        return $resultat;
    }
    //Ajouter des infos dans la desccription de l'utilisateur u site
    public function ajoutContenu($id_user)
    {
        $bdd = Bdd::Connection();
        $requete = $bdd->prepare("
        INSERT INTO contenus(nom,description,id_categorie,id_user)
        VALUES (:titre,:description,:id_categorie,:id_user)");
        $resultat = $requete->execute([
            ":titre" => $_POST['titre'],
            ":description" => $_POST['description'],
            ":id_categorie" => $_POST['id_categorie'],
            ":id_user" => $id_user
        ]);
        $bdd = null;
        return $resultat;
    }

    public function categorie()
    {
        $bdd = Bdd::Connection();

        $requete = $bdd->prepare("SELECT nom FROM categories");
        $requete->execute();
        $categorie = $requete->fetchAll();
        return $categorie;
    }
}

// test le model ProfilsModel et ses methodes
//$test=new ProfilsModel();
//$test->listeProfils();
//$test->Profil(2);