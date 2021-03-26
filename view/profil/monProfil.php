<pre style="display:none;"><?php var_dump($datas['compte']); ?></pre>
<div class="d-flex justify-content-center" style="align-items:center">
    <img class="photo-profil m-3" src="<?php echo $datas['compte']['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?php echo $datas['compte']['pseudo']; ?></h2>

            <?php if (!empty($_SESSION['user'])) { ?>
                <!-- Button trigger modal Modif Profil-->
                <button class="m-3 btn-modif">Modifier profil</button>
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
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['publications']; ?>121</p> Publication
            </div>
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['abonnes']; ?>111</p> Abonnées
            </div>
            <div class="d-flex">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte']['abonnements']; ?>121</p> Abonnements
            </div>
        </div>
        <div class="">
            <b><?php echo SessionFacade::getUserName(); ?>
                <?php echo SessionFacade::getUserPrenom(); ?></b>
            <p><?php echo $datas['compte']['description_compte'] ?></p>
        </div>
    </div>
</div>

<pre><?php var_dump($datas['compte']) ?></pre>

<div class="d-flex justify-content-center flex-wrap" id="photo-compte">
    <?php

    foreach ($datas['compte']['publications'] as $data) {

        echo '<div class="m-4">
        <a data-toggle="modal" data-target="#mediaModal"><img src="' . $data['media'] . '"></a>
    </div>';
    }
    ?>

</div>




<!-- Modal Nouveau Post-->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Publier</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Contact-->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3><?php echo SessionFacade::getUserName() ?></h3>
                    <textarea type="text" class="form-control" name="message" id="message" placeholder="Votre message..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal media cliqué-->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3><?php echo SessionFacade::getUserName() ?></h3>
                    <textarea type="text" class="form-control" name="message" id="message" placeholder="Votre message..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>