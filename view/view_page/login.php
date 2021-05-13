<!-- Formulaire de connexion à son compte et également page de retour après déconnexion -->
<div class="container d-flex mt-5 center">
    <div class="ResponsiveImg">
        <img src="/asset/img/login.png">
    </div>
    <div class="card p-5 responsiveLogin">
        <div class="text-center">
            <img src="/asset/img/ig-logo.png" class="mt-4 mb-4">
            <div style="font-weight: bold; font-size:x-large;">Connexion</div>
            <form action="/" method="POST" style="font-weight: bold;" class="card-body">
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
            <p>Vous n'avez pas de compte? <a href="view_inscription/inscription">Inscrivez-vous.</a></p>
        </div>
    </div>
</div>