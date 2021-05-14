<!DOCTYPE html>
<html lang=fr>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gretagram</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d3d6f2df1f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/asset/css/index.css">
    <link rel="stylesheet" type="text/css" href="/asset/css/profil.css">
    <link rel="stylesheet" type="text/css" href="/asset/css/inbox.css">
    <link rel="stylesheet" type="text/css" href="/asset/css/article.css">
    <link rel="stylesheet" type="text/css" href="/asset/css/responsive.css">



</head>

<body>
    <!-- navbar bootstrap instagram -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-light navModif">
            <div class="container justify-content-center">
                <div class="d-flex flex-row flex-grow justify-content-between align-items-center col-9 RESPNAVBAR">
                    <a class="navbar-brand" href="/home">
                        <!-- LOGO INSTA -->
                        <img src="/asset/img/ig-logo.png" loading="lazy">
                    </a>
                    <!-- Barre de recherche -->
                    <div>
                        <form class="form-inline my-2 my-lg-0" action="/recherche" method="GET">
                            <input type="hidden" name="page" value="recherche">
                            <input class="form-control mr-sm-2" type="search" name="q" id="q" placeholder="Search profil">
                            <button type="submit" style="display:none;" name="submit"></button>
                        </form>
                    </div>
                    <!-- Partie droite de la navbar avec icone HOME INBOX EXPLORE NOTIF PROFIL-->
                    <div class="d-flex flex-row responsiveNav">
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="/Home" class="link-menu">
                                    <i class="fas fa-home menu-btn"></i>
                                </a>
                            </li>
                            <li class="list-inline-item ml-2">
                                <a href="" class="link-menu">
                                    <i class="far fa-paper-plane menu-btn disabled bi bi-house-door-fill"></i>
                                </a>
                            </li>
                            <li class="list-inline-item ml-2">
                                <a href="/Explore" class="link-menu">
                                    <i class="far fa-compass menu-btn icon-post"></i>
                                </a>
                            </li>
                            <li class="list-inline-item ml-2">
                                <a href="" class="link-menu">
                                    <i class="far fa-heart disabled menu-btn"></i>
                                </a>
                            </li>
                            <li class="list-inline-item ml-2 align-middle">
                                <a href="/Profil" class="link-menu">
                                    <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border topbar-profile-photo">
                                        <img src="/<?= CompteFacade::getComptePhoto(); ?>" style="transform: scale(3); width: 100%; position: absolute; left: 0;">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <?php
    if (!empty($datas['message']['message'])) {
        echo '<center><div class="alert alert-' . $datas['message']['type'] . '">' . $datas['message']['message'] . '</div></center>';
    }
    ?>