<div class="d-flex justify-content-center" style="align-items:center">
    <img class="photo-profil img-thumbnail m-3" src="/<?php echo $datas['compte'][0]['photo'] ?>">
    <div style="margin-top: 30px; margin-bottom:30px; text-align:left;">
        <div class="header-profil">
            <h2 class="mt-3" style="font-weight: bold; margin-left:15px;"><?php echo $datas['compte'][0]['pseudo']; ?></h2>
            <button type="button" class="m-3 btn-modif" data-toggle="modal" data-target="#contactModal">Contacter</button>
            <button class="m-3 btn-modif">S'abonner</button>
        </div>
        <div class="header-profil">
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte'][0]['publications']; ?></p> Publications
            </div>
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte'][0]['abonnes']; ?></p> Abonnées
            </div>
            <div class="d-flex">
                <p class="mr-2" style="font-weight:bold;"><?php echo $datas['compte'][0]['abonnements']; ?></p> Abonnements
            </div>
        </div>
        <div class="">
            <p><?php echo $datas['compte'][0]['description_compte'] ?></p>
        </div>
    </div>
</div>

<pre style="display:none;"><?php var_dump($datas['compte']) ?></pre>

<div class="container">
    <div class="align-items-center">
        <div class="d-flex flex-wrap">
            <?php
            foreach ($datas['compte'] as $data) {
                echo '<div class="card thumbpic" style="width: 18rem;">
                <a href="/article&id_compte=' . $data['id_compte'] . '&id_article=' . $data["id_article"] . '"><img class="card-img-top" style="object-fit:fill;" src="/' . $data['media'] . '"></a>
                </div>';
            }
            ?>
        </div>
    </div>
</div>