<div class="card text-center">
    <div class="card-header">
        <!-- Formulaire de suppressiond du commentaire-->
    </div>
    <form action="" method="POST">
        <div class="card-body">
            <h5 class="card-title">Êtes vous sûr de vouloir effacer ce commentaire? Ce changement sera irréversible</h5>
            <p class="card-text">"<?php echo $datas['commentaire']['contenu_com']; ?>"</p>
            <button type="submit" name="submit" class="btn-com"><i class="far fa-check-circle"></i></button>
        </div>
    </form>
</div>