<br>
<div class="form-custom">
    <div class="card-header" style="font-size: larger; text-align:center; font-weight:bold;">Contact</div>
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
                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea type="text" class="form-control" name="message" id="message" placeholder="Entrez votre message" style="height: 200px;"></textarea>
            </div>
            <br>
            <button type="submit" class="btn-grad">Envoyer</button>
        </form>
        </p>
    </div>
</div>