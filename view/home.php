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
                                            <img src="<?= $article['photo'] ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                        </div>
                                        <a href="/compte/<?= $article['id_compte'] ?>" style="text-decoration:none; color:black;"><span class="font-weight-bold"><?= $article['pseudo'] ?></span></a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="embed-responsive embed-responsive-1by1">
                                        <img class="embed-responsive-item" src="<?= $article['media'] ?>" />
                                    </div>
                                    <div class="d-flex flex-row justify-content-between pl-3 pr-3 pt-3 pb-1">
                                        <ul class="list-inline d-flex flex-row align-items-center m-0">
                                            <li class="list-inline-item">
                                                <button class="btn p-0 toggle-like" data-article="<?= $article['id_article']; ?>">
                                                    <i class="fa-heart <?php echo ($article['articleAlreadyLiked']) ? 'fas' : 'far'; ?>"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item ml-2">
                                                <a href="/article&id_article=<?= $article['id_article'] ?>"><button class="btn p-0">
                                                        <svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                                                        </svg>
                                                    </button></a>
                                            </li>
                                            <li class="list-inline-item ml-2 ">
                                                <button class="btn p-0 disabled">
                                                    <svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.724 3.947l-7 3.5-.448-.894 7-3.5.448.894zm-.448 9l-7-3.5.448-.894 7 3.5-.448.894z" />
                                                        <path fill-rule="evenodd" d="M13.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-6.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                                    </svg>
                                                </button>
                                            </li>
                                        </ul>
                                        <div>
                                            <button class="btn p-0">
                                                <svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-hdd" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M14 9H2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1zM2 8a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2H2z" />
                                                    <path d="M5 10.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                                    <path fill-rule="evenodd" d="M4.094 4a.5.5 0 0 0-.44.26l-2.47 4.532A1.5 1.5 0 0 0 1 9.51v.99H0v-.99c0-.418.105-.83.305-1.197l2.472-4.531A1.5 1.5 0 0 1 4.094 3h7.812a1.5 1.5 0 0 1 1.317.782l2.472 4.53c.2.368.305.78.305 1.198v.99h-1v-.99a1.5 1.5 0 0 0-.183-.718L12.345 4.26a.5.5 0 0 0-.439-.26H4.094z" />
                                                </svg>
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
                                        <button class="open-commentaire" data-article="<?= $article['id_article'] ?>">
                                            Voir commentaires
                                        </button>

                                        <br><small class="text-muted">Article posté le <?= $article['date_art'] ?></small>
                                    </div>
                                    <div class="position-relative comment-box">
                                        <form action="" method="POST">
                                            <input class="w-100 border-0 p-3 input-post" name="comment" id="comment" placeholder="Add a comment...">
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