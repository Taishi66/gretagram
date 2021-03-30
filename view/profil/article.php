<!-- Modal media cliqué-->
<pre style="display:on;"><?php var_dump($datas); ?></pre>

<div class="modal-content">
    <div class="row">
        <div class="col-md-8">
            <img class="w-60" src="<?php echo $datas['article']['media']; ?>">
        </div>
        <div class="col-md-4">
            <div class="modal-body inline">
                <div class="row">
                    <h5><img class="photo-profil p-1" style="width: 20%;" src="<?php echo $datas['compte']['photo']; ?>"><?php echo $datas['compte']['pseudo'] ?></h5>
                    test commentaire
                </div>
            </div>
            <textarea class="form-groupe mb-0" placeholder="Laissez un commentaire..."></textarea>
        </div>
    </div>
</div>