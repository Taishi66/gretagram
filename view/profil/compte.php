<? DebugFacade::dump($datas); ?>
<div class="d-flex justify-content-center" style="align-items:center">
    <img class="photo-profil img-thumbnail m-3" src="/<?= $datas['compteVisite'][0]['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?= $datas['compteVisite'][0]['pseudo']; ?></h2>
            <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#contactModal">Contacter</button>
            <button class="m-3 btn-modif">S'abonner</button>
        </div>
        <div class="header-profil">
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compteVisite'][0]['publications']; ?></p> Publications
            </div>
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compteVisite'][0]['abonnes']; ?></p> Abonnées
            </div>
            <div class="d-flex">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compteVisite'][0]['abonnements']; ?></p> Abonnements
            </div>
        </div>
        <div class="">
            <p><?php echo $datas['compteVisite'][0]['description_compte'] ?></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="align-items-center">
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($datas['compteVisite'] as $data) {
                echo '<div class="card card-overlay" style="width: 18rem;">
                <a href="/article&id_compte=' . $data['id_compte'] . '&id_article=' . $data["id_article"] . '">
                  <div class="img-overlay" style="
                                background-image: url(/' . $data['media'] . '); 
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center; 
                                height: 300px;
                            "></div> 
                            <div class="overlay">
                                <ul>
                                    <li style="list-style-type:none;"><i class="fas fa-heart mr-2"></i> (' . $data['nbLikesForArticle'] . ')</li>
                                    <li style="list-style-type:none;"><i class="fas fa-comment mr-2"></i> (' . $data['nbCommentaireForArticle'] . ')</li>
                                </ul>
                            </div>
                            </a>
                </div>';
            }
            ?>
        </div>
    </div>
</div>