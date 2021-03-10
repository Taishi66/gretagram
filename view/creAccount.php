<br>
<?php echo @$message; ?>
<br>
<div class="form-custom">
    <div class="card-header" style="font-size: larger; text-align:center; font-weight:bold;"><i class="fas fa-user-alt mr-3"></i>Créez votre compte!</div>
    <div class="card-body">
        <p class="card-text">
        <form action="" method="POST" enctype='multipart/form-data' style="font-weight: bold;">
            <div class="form-group">
                <label>Pseudo</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choississez votre pseudo">
            </div>
            <div class="form-group">
                <label for="photo">Ajoutez une photo à votre compte</label><br>
                <input type="file" name="photo" id="photo">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description_compte" id="description_compte" placeholder="Décrivez en quelques mots votre contenu"></textarea>
            </div>
            <br>
            <button type="submit" class="btn-grad">Créez votre compte</button>
        </form>
        </p>
    </div>
</div>
<br>