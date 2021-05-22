<!-- La variable $myAccount n'existe que si l'id_compte de 
l'article visité est le même que l'id_compte du compte connecté-->
<?php $myAccount = ($datas['compte']['id_compte'] == $datas['article']['id_compte']); ?>
<div class="card mb-5 mt-5 ml-5 cardArticle RESPARTICLE">
    <div class="row no-gutters">
        <div class="col-md-4 btn-art">
            <!-- photo de 'article -->
            <img src="<?php echo $datas['article']['media']; ?>" class="w-100" alt="...">
            <div class="d-flex flex-row no-wrap justify-content-around">
                <!-- like de l'article vérifie (avec condition sur la classe du fontawesome) qu'il n'ait pas déjà été liké par le compte connecté:
                plein si déjà liké, vide pour l'inverse-->
                <div class="pl-3 pr-3 pb-2">
                    <button class="toggle-like btn-com" data-text="" data-article="<?= $datas['article']['id_article'] ?>">
                        <i class="fa-heart <?php echo ($datas['articleAlreadyLiked']) ? 'fas' : 'far'; ?>">
                            <strong class="d-block nb_likes" data-article="<?= $datas['article']['id_article'] ?>">
                                (<?php echo (!empty($datas['nbLikesForArticle'])) ? $datas['nbLikesForArticle'] : '0'; ?>)</strong>
                        </i></button>
                </div>
                <!-- Button de commentaire -->
                <button class="btn-com" data-toggle="modal" data-target="#modal-com"><i class="far fa-comment"></i></button>
                <!-- si myAccount existe alors button de modification et de suppression de l'article apparaissent -->
                <?php if ($myAccount) { ?>
                    <button class="btn-com" data-toggle="modal" data-target="#modif-article"><i class="mr-2 fas fa-pencil-alt"></i></button>
                    <button class="btn-com" data-toggle="modal" data-target="#modal-delete"><i class="far fa-trash-alt"></i></button>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-entete">
                    <!-- Photo et pseudo de l'entête sont défini par la condition : 
                    est ce que la clef [compteVisite] existe dans l'array $datas, si oui alors l'user est sur un article qui n'est pas le sien. -->
                    <a href="/compte/<?= $datas['compteVisite']['id_compte'] ?>" style="text-decoration: none; color:black;">
                        <h2><img class="photo-profil p-1" src="<?php echo (!empty($datas['compteVisite']['photo'])) ? $datas['compteVisite']['photo'] : $datas['compte']['photo']  ?>">
                            <?php echo (!empty($datas['compteVisite']['pseudo'])) ? $datas['compteVisite']['pseudo'] : $datas['compte']['pseudo']  ?>
                        </h2>
                    </a>
                </div>
                <!-- Titre et contenu de l'article -->
                <h3 class="card-title"><?php echo $datas['article']['titre']; ?></h3>
                <h4 class="card-text"><?php echo $datas['article']['contenu']; ?></h4>
            </div>
            <hr>
            <!-- Liste des commentaires -->
            <span class="comment-list" data-article="<?= $datas['article']['id_article'] ?>">
                <?php foreach ($datas['commentaire'] as $data) { ?>
                    <div class="mb-2 card-header cardCom commentaire">
                        <strong class="d-block"><?= $data['pseudo'] ?>
                            <!-- Button de suppression si myAccount existe -->
                            <?php if ($myAccount) { ?>
                                <a href="/Delete_com&id_com=<?= $data['id_com'] ?>">
                                    <span class="com-sup"><i class="far fa-trash-alt"></i></span>
                                </a>
                            <?php } ?>
                        </strong>
                        <!-- Date de post du commentaire -->
                        <span><?= $data['contenu_com'] ?></span>
                        <p class="text-muted" style="font-size: small;"><?= $data['date_com'] ?></p>
                    </div>
                <?php } ?>
            </span>
            <!-- Date de création de l'article -->
            <p class="card-text"><small class="text-muted m-2">Article créé le :<?php echo $datas['article']['date_art'] ?></small></p>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Envoi du commentaire, si l'attribut data-myaccount est true alors le commentaire posté apparaitra avec le button de suppression 
            l'attribut mediapage permet de récupérer le contenu de l'input comment-->
            <div class="comment-box">
                <div class="modal-body modalCom" data-article="<?php echo $datas['article']['id_article']; ?>" data-mediapage="media" data-myaccount="<?php echo ($myAccount) ? 'true' : 'false'; ?>">
                    <input class="w-100 border-0 p-3 input-post" name="comment" id="comment" placeholder="Tapez votre commentaire!"></input>
                    <button type="submit" nom="submit" class="btn-com btn-post-comment"><i class="far fa-paper-plane mr-1"></i></button>
                </div>
            </div>
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
                        <input type="file" class="form-control" name="media" id="media" value="<?php echo $datas['article']['media']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea type="text" class="form-control" name="contenu" id="contenu" placeholder="<?php echo $datas['article']['contenu']; ?>"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-com"><i class="far fa-paper-plane mr-1"></i></button>
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
                    <button type="submit" name="submit" class="btn-com"><i class="far fa-check-circle"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>