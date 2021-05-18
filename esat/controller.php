<?php
include('model.php');

class Controller
{
    private $model;

    function __construct()
    {
        $this->model = new Model();
    }


    function ajout()
    {

        $sexe = $_POST['sexe'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $description = $_POST['description'];
        $ville = $_POST['ville'];
        $email = $_POST['email'];
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        if (isset($_POST['submit'])) {
            return $this->model->add($sexe, $nom, $prenom, $description, $ville, $email, $mdp);
        }
    }
}
