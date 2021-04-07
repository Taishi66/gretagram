<pre style="display:none;"><?php var_dump($datas); ?></pre>

<div class="card text-center">
    <div class="card-header">
        Supprimer commentaire
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <h5 class="card-title">Êtes vous sûr de vouloir effacer ce commentaire? Ce changement sera irréversible</h5>
            <p class="card-text">"<?php echo $datas['commentaire']['contenu_com']; ?>"</p>
            <button type="submit" name="submit" class="btn-com"><i class="mr-2 fas fa-skull-crossbones"></i>Oui, je suis sûr</button>
        </div>
    </form>
</div>