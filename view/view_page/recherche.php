<div class="d-flex justify-content-center m-3 flex-wrap">
    <!-- Affiche chaque profil correspondant à la recherche sous forme de crad bootstrap -->
    <?php
    if (!empty($datas['recherche'])) {
        foreach ($datas['recherche'] as $data) {

            echo '<div class="card m-3" style="width: 18rem;">
                    <img class="card-img-top" src="' . $data['photo'] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $data['pseudo'] . '</h5>
                        <p class="card-text">' . $data['description_compte'] . '</p>
                        <a href="/compte/' . $data['id_compte'] . '" style="text-decoration:none;" class="btn-com">Voir le profil</a>
                    </div>
                </div>';
        }
    } else {
    ?><div class="alert alert-warning" role="alert">
            <i class="far fa-times-circle"> Aucun profil trouvé...</i>
        </div>
    <?php
    } ?>
</div>