<div class="container d-flex mt-5 mr-auto">
    <div>
        <img src="./img/insta.jpg">
    </div>
    <div class="card p-5">
        <?php echo @$message; ?>
        <div class="text-center">
            <img src="./img/ig-logo.png" class="mt-4 mb-4">
            <div>Inscription</div>
            <form action="" method="POST" style="font-weight: bold;" class="card-body">
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
                <button type="submit" class="btn-primary form-control">Connexion</button>
                <br>
            </form>
        </div>
    </div>
</div>