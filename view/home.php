<!-- BLOCK  BODY STORIES POST ET PROFIL / SUGGESTION-->
<? DebugFacade::dump($datas); ?>

<div class="mt-4">
    <div class="container d-flex justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-8">
                    <!-- START OF STORIES -->
                    <div class="card">
                        <div class="card-body d-flex justify-content-start">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= $datas['compte']['photo'] ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>JCLAMY</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="./img/profiles/profile-2.jpg" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>petermckinnon</small>
                                        </div>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END OF STORIES -->
                    <!-- START OF POSTS -->
                    <?php
                    foreach ($datas['article'] as $article) { ?>
                        <div class="d-flex flex-column mt-4 mb-4">
                            <div class="card">
                                <div class="card-header p-3">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger post-profile-photo mr-3">
                                            <a href="/compte/<?= $article['id_compte'] ?>" style="text-decoration:none; color:black;"><img src="<?= $article['photo'] ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;"></a>
                                        </div>
                                        <a href="/compte/<?= $article['id_compte'] ?>" style="text-decoration:none; color:black;"><span class="font-weight-bold"><?= $article['pseudo'] ?></span></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="embed-responsive embed-responsive-1by1">
                                        <a href="/article&id_article=<?= $article['id_article'] ?>" style="text-decoration:none; color:black;"><img class="embed-responsive-item" src="<?= $article['media'] ?>" /></a>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between pl-3 pr-3 pt-3 pb-1">
                                        <ul class="list-inline d-flex flex-row align-items-center m-0">
                                            <li class="list-inline-item">
                                                <button class="btn p-0 toggle-like icon-post" data-article="<?= $article['id_article']; ?>">
                                                    <i class="fa-heart <?php echo ($article['articleAlreadyLiked']) ? 'fas' : 'far'; ?>"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item ml-2 icon-post">
                                                <a href="/article&id_article=<?= $article['id_article'] ?>"><button class="btn p-0">
                                                        <i class="far fa-comment"></i>
                                                    </button></a>
                                            </li>
                                            <li class="list-inline-item ml-2 ">
                                                <button class="btn p-0 disabled icon-post">
                                                    <i class="fas fa-share-alt"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        <div>
                                            <button class="btn p-0 disabled icon-post">
                                                <i class="far fa-bookmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pl-3 pr-3 pb-2">
                                        <strong class="d-block nb_likes" data-article="<?= $article['id_article'] ?>"><?php echo (!empty($article['nbLikesForArticle'])) ? $article['nbLikesForArticle'] : '0'; ?> Like</strong>
                                        <strong class="d-block"><?= $article['titre'] ?></strong>
                                        <p class="d-block mb-1"><?= $article['contenu'] ?></p>
                                        <?php if (!empty($article['commentaires'])) {
                                            foreach ($article['commentaires'] as $key => $commentaire) { ?>
                                                <div class="commentaire <?php echo ($key > 0) ? 'hidden' : ''; ?>" data-article="<?= $article['id_article'] ?>">
                                                    <div>
                                                        <strong class="d-block"><?= $commentaire['pseudo'] ?></strong>
                                                        <span><?= $commentaire['contenu_com'] ?></span>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <p> Aucun commentaire </p>
                                        <?php } ?>
                                        <button class="open-commentaire text-muted" data-article="<?= $article['id_article'] ?>">
                                            Voir commentaires
                                        </button>
                                        <br><small class="text-muted">Article posté le <?= $article['date_art'] ?></small>
                                    </div>
                                    <div class="position-relative comment-box">
                                        <form action="" method="POST" id="comment-form">
                                            <input type="text" class="w-100 border-0 p-3 input-post" name="comment" id="comment" placeholder="Add a comment...">
                                            <button type="submit" class="btn btn-primary position-absolute btn-ig">Publier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php   } ?>
                    <!-- END OF POSTS -->
                </div>
                <div class="col-4">
                    <div class="d-flex flex-row align-items-center">
                        <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border sidenav-profile-photo">
                            <img src="<?= $datas['compte']['photo']; ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                        </div>
                        <div class="profile-info ml-3">
                            <a style="text-decoration: none; color:black;" href="/compte/<?= $datas['compte']['id_compte'] ?>"><span class="profile-info-username"><?= $datas['compte']['pseudo']; ?></span></a>
                            <span class="profile-info-name"><?= $datas['user']['nom']; ?> <?= $datas['user']['prenom']; ?></span>
                        </div>
                    </div>
                    <!-- SUGGESTION ET LIEN PROFIL-->
                    <div class="mt-4">
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-muted font-weight-normal">Suggestions For You</small>
                            <a href="/explore" style="text-decoration:none;"><small>See All</small></a>
                        </div>
                        <?php foreach ($datas['suggestion'] as $suggestion) { ?>
                            <div>
                                <div class="d-flex flex-row justify-content-between align-items-center mt-3 mb-3">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border sugest-profile-photo">
                                            <img src="<?= $suggestion['photo'] ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                        </div>
                                        <strong class="ml-3 sugest-username"><?= $suggestion['pseudo'] ?></strong>
                                    </div>
                                    <a href="/compte/<?= $suggestion['id_compte'] ?>" class="btn btn-primary btn-sm p-0 btn-ig">Voir le profil</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>