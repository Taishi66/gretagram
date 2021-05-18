<h1 class="titre">Resultat de la recherche :</h1>

<div class="listeProfils">

    <?php
    if (count($recherche) > 0) {

        foreach ($recherche as $data) {

            echo "<div class='photo' style='margin:10px;'>
                <img style='border-radius:20px; width:100%;'src='" . $data['image'] . "'><br>
                <a style='font-size:x-large; 
                          text-decoration:none;' 
                          href='index.php?page=profil&id=" . $data['id_user'] . "'>
                                                         " . $data['prenom'] . "
                                                         " . $data['nom'] . "</a>
             </div>";;
        }
    } else {
        echo "<h2 style='color:red'>aucun profil trouvé</h2>";
    }
    ?>
</div>