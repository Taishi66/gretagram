<?php
session_start();
echo $_SESSION["nom_user"];
?>

<h1>Authentification</h1>
<form action="" method="POST">
    email : <input type="email" name="email" id="email"> <br>
    mdp : <input type="text" name="mdp" id="mdp"><br>
    mdp confirme : <input type="text" name="mdpConfirm" id="mdpConfirm"><br>
    <button type="submit">OK</button>
</form>

<?php
if (isset($_POST['mdp'])) {

    echo $email = $_POST['email'];
    echo "<br>";
    echo $mdp = $_POST['mdp'];
    echo $mdpConfirme = $_POST['mdpConfirm'];
    echo "<br>";


    if ($mdp === $mdpConfirme) {
        echo "OK";
        $mdpBcrypt = password_hash($mdp, PASSWORD_DEFAULT);
        echo $mdpBcrypt; //
    }

    include("../bdd.php");
    $bdd = Bdd::Connection();

    // md5()
    /*
    echo "<br>";
    echo $mdpMd5 = md5($mdp);

    $profilMD5 = $bdd->prepare('SELECT * FROM users WHERE mdp=:mdp AND email=:email');
    $profilMD5->execute([":mdp" => $mdpMd5, ":email" => $email]);
    var_dump($profilMD5->fetch()); //test
*/
    //bcrypt


    $profilBcrypt = $bdd->prepare('SELECT * FROM users WHERE email=:email');
    $profilBcrypt->execute([":email" => $email]);
    $user = $profilBcrypt->fetch();

    echo $mdpBdd = $user["mdp"];

    /**
     * haché le MDP en bcrypt
     * echo password_hash(mdp en claire du formaulaire, PASSWORD_DEFAULT);
     * pour l'inscription
     */

    /**
     * verifie le mdp donné avec celui de la bdd et comparé
     * password_verify($mdp en claire du fromulaire, $mdpBdd haché de la bdd)
     * à chaque fois que je m'authontifie
     */

    if (password_verify($mdp, $mdpBdd)) {
        echo 'Le mot de passe est valide !';
        var_dump($user); //test

//      $_SESSION["nom_user"] =  $user["nom"];

    } else {
        echo 'Le mot de passe est invalide.';
    }
}
?>