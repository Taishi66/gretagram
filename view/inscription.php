<br>
<div class="form-custom">
    <div class="card-header" style="font-size: larger; text-align:center; font-weight:bold;">INSCRIPTION</div>
    <div class="card-body">
        <p class="card-text">
            <?php echo @$message; ?>
        <form action="" method="POST" style="font-weight: bold;">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom">
            </div>
            <div class="form-group">
                <label>Prenom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prenom">
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" 
                    class="form-control" 
                    name="email" 
                    id="email" 
                    placeholder="Entrez votre email" 
                    value="<?php if(!empty($datas['defaultDatas']['email'])) { 
                            echo $datas['defaultDatas']['email']; 
                    }?>">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Entrez votre mdp">
            </div>
            <br>
            <button type="submit" class="btn-grad">S'inscrire</button>
        </form>
        </p>
    </div>
</div>
<br>