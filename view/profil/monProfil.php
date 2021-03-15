<div class="d-flex justify-content-center" style="align-items:center">
    <img class="photo-profil m-3" src="././img/profiles/profile-1.jpg">
    <div style="margin-top: 30px; margin-bottom:30px">
        <div class="header-profil">
            <div class="mt-4" style="font-weight: bold; margin-left:15px;"><?php echo $profil['pseudo']; ?></div>
            <button class="m-3 btn-modif">Modifier profil</button>
            <button class="m-3 btn-modif"><a href="?page=deconnexion" style="color: black; ;text-decoration:none;">Déconnexion</a></button>
        </div>
        <div class="header-profil">
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;">121</p>Publication
            </div>
            <div class="d-flex mr-3">
                <p class="mr-2" style="font-weight:bold;">121</p> Abonnées
            </div>
            <div class="d-flex">
                <p class="mr-2" style="font-weight:bold;">121</p> Abonnements
            </div>
        </div>
       <div class=""><?php //echo  $profil['prenom']; ?>
            <?php //echo  strtoupper($profil['nom']); ?> 
            <p>Description</p>
        </div>
    </div>



</div>
<div class="d-flex justify-content-center flex-wrap" id="photo-compte">
    <div class="m-4">
        <a href="" data-target="#modal" data-toggle="modal"><img src="https://picsum.photos/350/350"></a>
    </div>
    <div class="m-4">
        <a href=""><img src="https://picsum.photos/350/350"></a>
    </div>
    <div class="m-4">
        <a href=""><img src="https://picsum.photos/350/350"></a>
    </div>
    <div class="m-4">
        <a href=""><img src="https://picsum.photos/350/350"></a>
    </div>
    <div class="m-4">
        <a href=""><img src="https://picsum.photos/350/350"></a>
    </div>
    <div class="m-4">
        <a href=""><img src="https://picsum.photos/350/350"></a>
    </div>
</div>


<!-- MODAL ARTICLE-->
<div class="modal" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content d-flex row">
            <img class="mr-2" src="https://picsum.photos/350/350">
            <div class="card-body">
                <p>Modal body text goes here.</p>
            </div>
        </div>
    </div>
</div>

<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>