<br>
<div class="form-custom">
    <div class="card-header" style="font-size: larger; font-weight:bold; text-align:center;">CONNEXION</div>
    <div class="card-body">
        <p class="card-text">
            <?php echo @$message; ?>
        <form action="" method="POST" style="font-weight: bold;">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Entrez votre mdp">
            </div>
            <br>
            <button type="submit" class="btn-grad">Se connecter</button>
        </form>
        </p>
    </div>
</div>
<br>