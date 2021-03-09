<h1>LISTE TEST</h1>
<div class="listeProfils">
<?php
foreach ($listeProfils as $profil) {

    echo "<div class='card'>
    
    <a href='index.php?page=profil&id=" . $profil['id_user'] . "'>
    " . $profil['prenom'] . "
    " . $profil['nom'] . "
    </a>
    </div>";
}
?>

</div>