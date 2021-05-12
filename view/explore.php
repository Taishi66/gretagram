<div class="container mt-5">
    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach ($datas['compteVisite'] as $data) { ?>
            <div class="card mt-5" style="width: 18rem;">
                <img class="card-img-top" src="<?= $data['photo'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['pseudo'] ?></h5>
                    <p class="card-text"><?= $data['description_compte'] ?></p>
                    <p class="font-weight-bold"><?= $data['publications'] ?> publications</p>
                    <a href="/Compte/<?= $data['id_compte'] ?>" style="text-decoration:none; color:blue; font-size:x-large;">Voir le profil</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>