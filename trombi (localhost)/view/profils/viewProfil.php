<h1 class="titre"><?php echo $profil['nom']; ?> <?php echo $profil['prenom']; ?></h1>
<br>
<div class="row container-fluid">
    <!-- affiche les informations du profil -->
    <div class="col-4 photo">
        <img src="<?php echo $profil['image']; ?>" class="figure-img img-fluid rounded"><br>
        <b>
            <?php echo  $profil['prenom']; ?>
            <?php echo  strtoupper($profil['nom']); ?>
        </b>
        <br> <?php echo  $profil['infos']; ?>
        <br> <?php echo  $profil['email']; ?>
        <br>
        <hr>

        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $profil['id_user']) { ?>
            <button type="button" class="btn btn-style" data-toggle="modal" data-target="#exampleModal">
                Modifier
            </button>
        <?php } ?>
    </div>
    <!-- affiche les categories et le contenus du profil -->
    <div class="col-8">
        <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $profil['id_user']) { ?>
            <button type="button" class="btn btn-style" data-toggle="modal" data-target="#modalInfos">
                Ajouter une information
            </button>
        <?php } ?>
        <?php
        // je declare la variable $cat vide
        $cat = "";
        foreach ($profilConCat as $data) {
            // je fait un cotrole si $cat et different de $data['id_categorie'] j'affiche la categorie
            // si non je $afficheCat et vide
            // $afficheCat = ($cat != $data['id_categorie']) ? "<h3>" .  $data['cat'] . "</h3>" : "";
            if ($cat != $data['id_categorie']) {
                $afficheCat = "<h3 >" .  $data['cat'] . "</h3>";
            } else {
                $afficheCat = "";
            }
            echo "         
            " . $afficheCat . "        
            <b >  " .  $data['nom'] . " </b>
            <p > " . $data['description'] . "</p>
            ";
            // j'alimente la variabe $cat par l'id de la categorie
            $cat = $data['id_categorie'];
        } ?>
    </div>

    <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $profil['id_user']) { ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification du profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $profil['id_user']; ?>">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $profil['nom']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $profil['prenom']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="nom">Description</label>
                                <textarea class="form-control" name="infos"><?php echo $profil['infos']; ?></textarea>
                            </div>
                            <div class=" form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image" id="image" value="<?php echo $profil['image']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="cv">CV</label>
                                <input type="file" class="form-control" name="cv" id="cv" value="<?php echo $profil['cv']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $profil['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" class="form-control" name="mdp" id="mdp" value="<?php echo $profil['mdp']; ?>">
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-style">Enregistrer les modifications</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $profil['id_user']) { ?>
        <div class="modal fade" id="modalInfos" tabindex="-1" role="dialog">
            <form action="" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter une catégorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label>Catégorie</label>
                            <select name="id_categorie">
                                <option selected="">Choisir une catégorie</option>
                                <?php
                                foreach ($categorie as $data) {
                                    echo "<option value='" . $data['id_categorie'] . "'>" . $data['nom'] . "</option>";
                                }
                                ?>
                            </select>
                            <br><label>Titre</label>
                            <br><input type="text" name="titre">
                            <br><label>Contenu</label>
                            <br><textarea name="description" id="description"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submitContenu" class="btn btn-style">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>