<pre style="display:none;"><?php var_dump($datas); ?></pre>

<div class="card mb-5 mt-5 ml-5 cardArticle">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?php echo $datas['article']['media']; ?>" class="card-img w-80" alt="...">
            <button class="btn-com" data-toggle="modal" data-target="#modal-com"><i class="mr-2 fab fa-instagram"></i>Laissez un commentaire</button>
            <?php if (!empty($_SESSION['user'])) { ?>
                <button class="btn-com" data-toggle="modal" data-target="#modif-article"><i class="mr-2 fas fa-pencil-alt"></i>Modifier l'article</button>
                <button class="btn-com" data-toggle="modal" data-target="#modal-delete"><i class="far fa-trash-alt"></i></button>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-entete">
                    <h2><img class="photo-profil p-1" style="width: 20%;" src="<?php echo $datas['compte']['photo']; ?>">
                        <?php echo $datas['compte']['pseudo'] ?>
                    </h2>
                </div>
                <h3 class="card-title"><?php echo $datas['article']['titre']; ?></h3>
                <h4 class="card-text"><?php echo $datas['article']['contenu']; ?></h4>
                <?php foreach ($datas['commentaire'] as $data) {
                    echo '<div>
                        <strong class="d-block">' . $data['pseudo'] . '</strong>
                        <span>' . $data['contenu_com'] . '</span>
                    </div>';
                } ?>
                <p class="card-text"><small class="text-muted"><?php echo $datas['article']['date_art'] ?></small></p>
            </div>
        </div>
    </div>
</div>




<!-- Modal Commentaire-->
<div class="modal fade" id="modal-com" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body modalCom">
                    <textarea name="commentaire" id="commentaire" placeholder="Tapez votre commentaire!"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" nom="submit-com" class="btn-com"><i class="far fa-paper-plane mr-1"></i>Postez!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier un article-->
<div class="modal fade" id="modif-article" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modifiez votre publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" value="<?php echo $datas['article']['titre']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Média</label>
                        <input type="text" class="form-control" name="media" id="media" value="<?php echo $datas['article']['media']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea type="text" class="form-control" name="contenu" id="contenu" placeholder="<?php echo $datas['article']['contenu']; ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date_art" id="date_art" placeholder="date...">
                    </div </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-com"><i class="far fa-paper-plane mr-1"></i>Postez!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal effacer un article-->

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-modif">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Effacez l'article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-footer">
                    <p>Êtes-vous sûr de vouloir effacer cet article? Cette modification sera irréversible.</p>
                    <button type="submit" name="submit" class="btn-com"><i class="mr-2 fas fa-skull-crossbones"></i>Oui, je suis sûr</button>
                </div>
            </form>
        </div>
    </div>
</div>