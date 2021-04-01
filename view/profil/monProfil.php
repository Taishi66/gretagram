<pre style="display:none;"><?php var_dump($datas['compte']); ?></pre>

<div class="d-flex justify-content-center" style="align-items:center">
    <img class="photo-profil img-thumbnail m-3" src="<?php echo $datas['compte']['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?php echo $datas['compte']['pseudo']; ?></h2>

            <?php if (!empty($_SESSION['user'])) { ?>
                <!-- Button trigger modal Modif Profil-->
                <button class="m-3 btn-modif" data-toggle="modal" data-target="#modifierModal">Modifier profil</button>
                <!-- Button trigger modal Nouveau Post-->
                <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#postModal">Nouveau Post</button>
                <button class="m-3 btn-modif"><a href="?page=deconnexion" style="color: black; ;text-decoration:none;">Déconnexion</a></button>

            <?php } else { ?>
                <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#contactModal">Contacter</button>
                <button class="m-3 btn-modif">S'abonner</button>
            <?php }  ?>
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
    <div class="row justify-content-center">
        <div class="d-flex flex-wrap">
            <?php
            foreach ($datas['compte']['articles'] as $data) {
                echo '<div class="mb-4 col-3 thumbpic">
        <a href="?page=article&id_article=' . $data['id_article'] . '"><img class="img-thumbnail w-100" src="' . $data['media'] . '"></a>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Nouveau post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de votre post">
                    </div>
                    <div class="form-group">
                        <label>Média</label>
                        <input type="text" class="form-control" name="media" id="media" placeholder="Photo ou vidéo">
                    </div>
                    <div class="form-group">
                        <label>Contenu</label>
                        <input type="text" class="form-control" name="contenu" id="contenu" placeholder="Ajoutez une légende">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date_art" id="date_art" placeholder="date...">
                    </div>
                </div>
                <div class="modal-footer modal-modif">
                    <button type="submit" class="form-control">Publier</button>
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
                        <label>Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $datas['compte']['pseudo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control" name="photo" id="photo" value="<?php echo $datas['compte']['photo']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description_compte" id="description_compte" placeholder="<?php echo $datas['compte']['description_compte']; ?>"></textarea>
                    </div>
                </div>
                <div class="modal-modif modal-footer">
                    <button type="submit" class="form-control">Valider Modifications</button>
                    <button type="submit" class="form-control" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>