<div class="d-flex justify-content-center">
    <div>
        <img src="./img/signup.png">
    </div>
    <div>
        <div class="form-custom mt-5">
            <div class="card-header c-head" style="text-align:center;">Créez votre compte pour pouvoir<br> partager vos photos et vidéos avec vos amis</div>
            <div class="card card-body">
                <p class="card-text">
                <form action="/noAccount" method="POST" style="font-weight: bold;">
                    <div class="form-group">
                        <label>Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choississez le pseudo de votre compte">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo de profil">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description_compte" id="description_compte" placeholder="Description du compte"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="form-control btn-primary">Créer le compte</button>
                    <hr>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>