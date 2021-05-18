<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('controller.php'); ?>
    <form method="post" action="">
        <input type="radio" name="sexe">Homme
        <input type="radio" name="sexe">femme
        <input name="nom" id="nom" placeholder="entrez votre nom">
        <input name="prenom" id="prenom" placeholder="entrez votre prenom">
        <select name="ville" id="ville">
            <option>Paris</option>
            <option>Lyon</option>
        </select>
        <textarea name="description" id="description"></textarea>
        <input name="email" id="email" placeholder="mail">
        <input name="mdp" id="mdp" placeholder="mdp">
        <button type="submit" name="submit">envoyer</button>
    </form>
    <?php $controller = new Controller();
    $controller->ajout();
    ?>
</body>

</html>