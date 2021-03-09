<br>
<div class="card border-secondary mb-3" style="margin: auto; max-width: 80%;">
    <div class="card-header" style="font-size: larger;">𝓒𝓸𝓷𝓷𝓮𝔁𝓲𝓸𝓷</div>
    <div class="card-body">
        <p class="card-text">
            <?php echo @$message; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="logEmail" id="logEmail" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="logMdp" id="logMdp" placeholder="Entrez votre mdp">
            </div>
            <br>
            <button type="submit" class="btn login">Se connecter</button>
        </form>
        </p>
    </div>
</div>
<br>