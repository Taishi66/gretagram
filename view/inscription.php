<br>
<div class="card border-secondary mb-3" style="margin: auto; max-width: 80%;">
    <div class="card-header" style="font-size: larger;">𝓘𝓷𝓼𝓬𝓻𝓲𝓹𝓽𝓲𝓸𝓷</div>
    <div class="card-body">
        <p class="card-text">
            <?php echo @$message; ?>
        <form action="" method="POST">
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
                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Entrez votre mdp">
            </div>
            <br>
            <button type="submit" class="btn login">S'inscrire</button>
        </form>
        </p>
    </div>
</div>
<br>