<!--TEMPLATE DE CREATION DE COMPTE APRES INSCRIPTION -->
<div class="d-flex justify-content-center">
    <div class="ResponsiveImg">
        <img src="/asset/img/signup.png">
    </div>
    <div>
        <div class="form-custom mt-5">
            <div class="card-header c-head" style="text-align:center;">Créez votre compte pour pouvoir<br> partager vos photos et vidéos avec vos amis</div>
            <div class="card card-body">
                <p class="card-text">
                <form action="/NoAccount" method="POST" style="font-weight: bold;" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pseudo*</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choississez le pseudo de votre compte">
                    </div>
                    <div class="form-group">
                        <label>Photo*</label>
                        <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo de profil">
                    </div>
                    <div class="form-group">
                        <label>Description*</label>
                        <textarea type="text" class="form-control" name="description_compte" id="description_compte" placeholder="Description du compte"></textarea>
                    </div>
                    <br>
                    <button type="submit" name="newAccount" class="form-control btn-primary">Créer le compte</button>
                    <hr>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>