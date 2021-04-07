<div class="d-flex justify-content-center m-3">

    <?php
    if (!empty($datas['recherche'])) {
        foreach ($datas['recherche'] as $data) {

            echo '<div class="card m-3" style="width: 18rem;">
                    <img class="card-img-top" src="' . $data['photo'] . '">
                    <div class="card-body">
                        <h5 class="card-title">' . $data['pseudo'] . '</h5>
                        <p class="card-text">' . $data['description_compte'] . '</p>
                        <a href="?page=compte&id_compte=' . $data['id_compte'] . '" style="text-decoration:none;" class="btn-com">Voir le profil</a>
                    </div>
                </div>';
        }
    } else {
    ?> No result <?php
                } ?>
</div>