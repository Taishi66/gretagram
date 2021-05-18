<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styleNavbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>TROMBIBIIIIIIIII</title>
</head>

<body>
    <nav id="menu">
        <ul>
            <li>
                <a href="index.php?page=profils">PROFILS</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
            <?php if (isset($_SESSION['id_user'])) { ?>
                <li>
                    <a href="index.php?page=monProfil"><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></a>
                </li>
                <li>
                    <a href="index.php?page=deconnexion">Déconnexion</a>
                </li>
                <li>
                <?php } else { ?>
                <li>
                    <a href="index.php?page=connexion">Connexion</a>
                </li>
                <li>
                    <a href="index.php?page=inscription">Inscription</a>
                </li>
                <li>
                    <a href="index.php?page=adminAjax">ajax</a>
                </li>
            <?php } ?>
            <li>
                <form class="form-inline my-2 my-lg-0" action="index.php?page=recherche" method="GET">
                    <input type="hidden" name="page" value="recherche">
                    <input class="form-control mr-sm-2" name="q" id="q" type="search" placeholder="Trouver un utilisateur">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="submit">Search</button>
                </form>
            </li>
        </ul>
    </nav>