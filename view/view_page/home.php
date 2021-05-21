<!-- BLOCK BODY STORIES POST ET PROFIL / SUGGESTION-->
<div class="mt-4">
    <div class="container d-flex RESPHOME">
        <div class="w-100">
            <div class="row justify-content-center">
                <div class="col-sm-6 RESPPOST">
                    <!-- BLOC DES STORIES fonctionnalitée à produire -->
                    <div class="card">
                        <div class="card-body d-flex justify-content-start">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>lululul</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>Bientôt...</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>Les</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>stories</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>seront</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>disponibles!</small>
                                        </div>
                                    </button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn p-0 m-0 ">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger story-profile-photo">
                                                <img src="<?= PokemonFacade::getPokemon(); ?>" alt="..." style="transform: scale(1.5); width: 100%; position: absolute; left: 0;">
                                            </div>
                                            <small>!!!!!!!!!!!!!</small>
                                        </div>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END OF STORIES -->
                    <!-- BLOCK DES POSTS -->
                    <?php
                    foreach ($datas['article'] as $article) { ?>
                        <div class="d-flex flex-column mt-4 mb-4">
                            <div class="card">
                                <div class="card-header p-3">
                                    <div class="d-flex flex-row align-items-center">
                                        <!-- Entête cliquable qui redirige vers le compte de l'article -->
                                        <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border border-danger post-profile-photo mr-3">
                                            <a href="/Compte/<?= $article['id_compte'] ?>" style="text-decoration:none; color:black;">
                                                <img src="<?= $article['photo'] ?>" style="transform: scale(3); width: 100%; position: absolute; left: 0;"></a>
                                        </div>
                                        <a href="/Compte/<?= $article['id_compte'] ?>" style="text-decoration:none; color:black;">
                                            <span class="font-weight-bold"><?= $article['pseudo'] ?></span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Photo cliquable qui redirige vers le compte de la photo -->
                                <div class="card-body p-0">
                                    <div class="embed-responsive embed-responsive-1by1">
                                        <a href="/Article&id_article=<?= $article['id_article'] ?>" style="text-decoration:none; color:black;">
                                            <img class="embed-responsive-item" src="<?= $article['media'] ?>" /></a>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between pl-3 pr-3 pt-3 pb-1">
                                        <ul class="list-inline d-flex flex-row align-items-center m-0">
                                            <!-- On vérifie avec une condition si l'article est déjà liké par le compte connecté -->
                                            <li class="list-inline-item">
                                                <button class="btn p-0 toggle-like icon-post" data-text="Like" data-article="<?= $article['id_article']; ?>">
                                                    <i class="fa-heart <?php echo ($article['articleAlreadyLiked']) ? 'fas' : 'far'; ?>"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item ml-2 icon-post">
                                                <a href="/Article&id_article=<?= $article['id_article'] ?>"><button class="btn p-0">
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
                                        <!-- Conditions pour afficher like ou likeS. -->
                                        <strong class="d-block nb_likes" data-article="<?= $article['id_article'] ?>">
                                            <?php echo (!empty($article['nbLikesForArticle'])) ? $article['nbLikesForArticle'] : '0'; ?>
                                            Like
                                            <?php echo ($article['nbLikesForArticle'] && $article['nbLikesForArticle'] > 1) ? 's' : ''; ?>
                                        </strong>
                                        <strong class="d-block"><?= $article['titre'] ?></strong>
                                        <p class="d-block mb-1"><?= $article['contenu'] ?></p>
                                        <!-- Affichage des commentaires -->
                                        <span class="comment-list" data-article="<?= $article['id_article'] ?>">
                                            <?php if (!empty($article['commentaires'])) {
                        foreach ($article['commentaires'] as $key => $commentaire) { ?>
                                                    <!-- Condition si nombre commentaires > 0 alors on les affiches -->
                                                    <div class="commentaire <?php echo ($key > 0) ? 'hidden' : ''; ?>" data-article="<?= $article['id_article'] ?>">
                                                        <div>
                                                            <strong id="comPseudo" class="d-block"><?= $commentaire['pseudo'] ?></strong>
                                                            <span id="comPost" class="d-block"><?= $commentaire['contenu_com'] ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php
                    } else { ?>
                                                <!-- Si commentaire < 0 alors on affiche ce message -->
                                                <p class="no-comment"> Aucun commentaire </p>
                                            <?php } ?>
                                            <?php if (!empty($article['commentaires']) && $article['commentaires'] > 3) { ?>
                                                <button class="open-commentaire text-muted" data-article="<?= $article['id_article'] ?>">
                                                    Voir commentaires
                                                </button>
                                            <?php } ?>
                                        </span>
                                        <br><small class="text-muted">Article posté le <?= $article['date_art'] ?></small>
                                    </div>
                                    <div class="comment-box">
                                        <div class="position-relative form-comment" data-article="<?= $article['id_article'] ?>">
                                            <input type="text" class="w-100 border-0 p-3 input-post" name="comment" id="comment" placeholder="Add a comment...">
                                            <button type="submit" name="submit" class="btn btn-primary position-absolute btn-ig btn-post-comment">Publier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php   } ?>
                    <!-- END OF POSTS -->
                    <!-- LIEN VERS LE COMPTE CONNECTÉ -->
                </div>
                <div class="col-3 suggestions">
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
                    <div class="mt-4 suggestions">
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-muted font-weight-normal">Suggestions pour vous</small>
                            <a href="/Explore" style="text-decoration:none;"><small>Voir Tout</small></a>
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
                                    <a href="/Compte/<?= $suggestion['id_compte'] ?>" class="btn btn-primary btn-sm p-0 btn-ig">Voir le profil</a>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-muted font-weight-normal">À propos Aide Presse API Emplois Confidentialité Conditions
                                Lieux Comptes principaux Hashtags Langue
                                Français
                                <br>
                                <br>© 2021 INSTAGRAM PAR FACEBOOK</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>