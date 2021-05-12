<div class="d-flex justify-content-center RESPPROFIL" style="align-items:center">
    <img class="photo-profil img-thumbnail m-3" src="<?php echo $datas['compte']['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil RESPBTN">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?php echo $datas['compte']['pseudo']; ?></h2>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navProfil"><i class="fas fa-dharmachakra" style="font-size: xx-large;"></i></button>
            <div id="navProfil" class="collapse navbar-collapse">
                <?php if (!empty($_SESSION['user'])) { ?>
                    <!-- Button trigger modal Modif Profil-->
                    <button class="m-3 btn-modif" data-toggle="modal" data-target="#modifierModal">Modifier profil</button>
                    <!-- Button trigger modal Nouveau Post-->
                    <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#postModal">Nouveau Post</button>
                    <!-- Button récupérer ses donnés instagram-->
                    <a href="instagram"><button class="m-3 btn-modif">Instagram</button></a>
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

<pre style="display:none;"><?php var_dump($datas['compte']) ?></pre>

<div class="container">
    <div class="align-items-center">
        <div class="d-flex flex-wrap justify-content-center">
            <?php
            foreach ($datas['article'] as $data) {
                echo '
                    <div class="card card-overlay" style="width: 18rem;">
                        <a href="/article&id_article=' . $data['id_article'] . '">
                            <div class="img-overlay" style="
                                background-image: url(' . $data['media'] . '); 
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


<!-- Modal Nouveau Post-->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header modal-modif">
                <h5 class="modal-title" id="exampleModalLongTitle">Nouveau post<p class="text-muted small">Pensez à remplir tout les champs!</p>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre*</label>
                        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de votre post">
                    </div>
                    <div class="form-group">
                        <label>Média*</label>
                        <input type="file" class="file" name="media" id="media" placeholder="Photo ou vidéo">
                    </div>
                    <div class="form-group">
                        <label>Contenu*</label>
                        <input type="text" class="form-control" name="contenu" id="contenu" placeholder="Ajoutez une légende">
                    </div>
                </div>
                <div class="modal-footer modal-modif">
                    <button type="submit" name="submit-post" id="submit-post" class="form-control">Publier</button>
                    <button type="submit" class="form-control" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Modifier Profil-->
<div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header modal-modif">
                <h5 class="modal-title">Modifier votre profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pseudo*</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?= $datas['compte']['pseudo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Photo*</label>
                        <input type="file" class="form-control" name="photo" id="photo" value="<?= $datas['compte']['photo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description*</label>
                        <input style="height:100px;" type="text" class="form-control" name="description_compte" id="description_compte" value="<?= $datas['compte']['description_compte']; ?>"></input>
                    </div>
                </div>
                <div class="modal-modif modal-footer">
                    <button type="submit" name="submit-modif" class="form-control">Valider Modifications</button>
                    <button type="submit" class="form-control" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Supprimer Profil-->
<div class="modal fade" id="account-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Effacez le compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-footer">
                    <p>Êtes-vous sûr de vouloir effacer votre compte? Cette suppression sera irréversible et les données effacées.</p>
                    <button type="submit" name="delete-compte" class="btn-com"><i class="far fa-check-circle"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>