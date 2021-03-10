<!DOCTYPE html>
<html lang=fr>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gretagram</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/responsive.css">


    <!-- bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- navbar bootstratp custom -->
    <nav class="navbar navbar-custom navbar-expand-lg" id="menu">
        <a class="navbar-brand" style="font-size: xx-large; color:black;" href="index.php">
            GRETAGRAM
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['id_user'])) { ?>
                    <a class="nav-link text-light btn-login" href="?page=monProfil"><i class="fas fa-user-circle mr-3"></i><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></a>
                    <a class="nav-link text-light btn-logout" href="?page=deconnexion"><i class="fas fa-power-off mr-3"></i>Déconnexion</a>
                <?php } else { ?>
                    <a class="nav-link text-light btn-login" href="?page=inscription"><i class="fas fa-user-plus mr-3"></i>Inscription</a>
                    <a class="nav-link text-light btn-login" href="?page=login"><i class="fas fa-sign-in-alt mr-3"></i>Log In</a>
                <?php } ?>

            </div>
            <div class="col-lg-6 mx-auto">
                <form>
                    <div class="input-group">
                        <input type="search" placeholder="Search profil" class="form-control">
                        <button class="btn btn-outine-light btn-light" type="button submit">
                            <i class="fab fa-searchengin"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="navbar-nav font-weight-bold">
                <!--<a class="nav-link text-dark" href="#"><i class="fab fa-linux mr-2"></i>Admin</a>-->
                <a class="nav-link text-light btn-logout" href="?page=contact"><i class="fas fa-at"></i></a>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>