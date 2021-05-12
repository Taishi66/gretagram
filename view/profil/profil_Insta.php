<div class="d-flex justify-content-center RESPPROFIL" style="align-items:center">
    <img class="photo-profil img-thumbnail m-3" src="<?php echo $datas['compte']['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil RESPBTN">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?= $datas['compte']['pseudo']; ?></h2>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navProfil"><i class="fas fa-dharmachakra" style="font-size: xx-large;"></i></button>
            <div id="navProfil" class="collapse navbar-collapse">
                <?php if (!empty($_SESSION['user'])) { ?>
                    <!-- Button trigger modal Modif Profil-->
                    <button class="m-3 btn-modif" data-toggle="modal" data-target="#modifierModal">Modifier profil</button>
                    <!-- Button trigger modal Nouveau Post-->
                    <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#postModal">Nouveau Post</button>
                    <!-- Button récupérer ses donnés instagram-->
                    <a href="profil"><button type="button" class="m-3 btn-modif">Gretagram</button></a>
                    <!-- Button trigger vider la session-->
                    <button class="m-3 btn-modif"><a href="/deconnexion" style="color: black; ;text-decoration:none;">Déconnexion</a></button>
                    <button class="m-3 ellipse" style="color: black; ;text-decoration:none;" data-toggle="modal" data-target="#account-delete"><i class="fas fa-ellipsis-v"></i></button>
                <?php }  ?>
            </div>
        </div>
        <div class="header-profil">
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['publications']; ?></p> Publications
            </div>
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['abonnes']; ?></p> Abonnées
            </div>
            <div class="d-flex">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['abonnements']; ?></p> Abonnements
            </div>
        </div>
        <div class="">
            <b><?php echo SessionFacade::getUserName(); ?>
                <?php echo SessionFacade::getUserPrenom(); ?></b>
            <p><?php echo $datas['compte']['description_compte'] ?></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="align-items-center">
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($datas['article']['data'] as $data) {
                echo '
                    <div class="card card-overlay" style="width: 18rem;">
                        <a>
                            <div class="" style="
                                background-image: url(' . $data['media_url'] . '); 
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center; 
                                height: 300px;
                            "></div>
                        </a>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>