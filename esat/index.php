<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("vendor/autoload.php");
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    ?>

    <?php include('controller.php'); ?>
    <center>
        <form method="post" action="">
            <input type="radio" name="sexe">Homme<br>
            <input type="radio" name="sexe">femme<br>
            <input name="nom" id="nom" placeholder="entrez votre nom"><br><br>
            <input name="prenom" id="prenom" placeholder="entrez votre prenom"><br><br>
            <select name="ville" id="ville"><br><br>
                <option>Paris</option>
                <option>Lyon</option>
            </select><br><br>
            <textarea name="description" id="description"></textarea><br><br>
            <input name="email" id="email" placeholder="mail"><br><br>
            <input name="mdp" id="mdp" placeholder="mdp"><br><br>
            <button type="submit" name="submit">envoyer</button>
        </form>
    </center>
    <?php $controller = new Controller();
    $controller->ajout();
    ?>
</body>

</html>