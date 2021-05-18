<h1 class="titre2">Liste des Profils</h1>
<div class="listeProfils container-fluid">
    <?php
    foreach ($listeProfils as $profil) {
        echo "<div class='photo'>
                <img style='border-radius:20px; width:100%;'src='" . $profil['image'] . "'><br>
                <a style='font-size:x-large; 
                          text-decoration:none;' 
                          href='index.php?page=profil&id=" . $profil['id_user'] . "'>
                                                         " . $profil['prenom'] . "
                                                         " . $profil['nom'] . "</a>
             </div>";
    }
    ?>

</div>