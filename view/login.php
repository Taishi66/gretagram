<div class="container d-flex mt-5 mr-auto">
    <div>
        <img src="./img/login.png">
    </div>
    <div class="card p-5">
        <div class="text-center">
            <img src="./img/ig-logo.png" class="mt-4 mb-4">
            <div style="font-weight: bold; font-size:x-large;">Connexion</div>
            <form action="" method="POST" style="font-weight: bold;" class="card-body">
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
            <p>Vous n'avez pas de compte? <a href="?page=inscription">Inscrivez-vous.</a></p>
            <?php echo $datas['message']; ?>
        </div>
    </div>
</div>