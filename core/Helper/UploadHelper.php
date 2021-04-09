<?php

class UploadHelper
{

    public function Upload($media)
    {

        if (isset($_FILES['media'])) {
            //$_FILES existe on récupère les infos qui nous intéressent
            $fichier = $_FILES['media']['name']; //nom réel de l'image
            $size = $_FILES['media']['size']; //poids de l'image en octets
            $tmp = $_FILES['media']['tmp_name']; //nom temporaire de l'image (sur le serveur)
            $type = $_FILES['media']['type']; //type de l'image
            //On récupère la taille de l'image
            list($width, $height) = getimagesize($tmp);
            if (is_uploaded_file($tmp)) //permet de vérifier si le fichier a été uplodé via http
            {
                //vérification du type de l'img, son poids et sa taille
                if ($type == "image/gif" && $size <= 20500 && $width <= 100 && $height <= 100) {
                    // type mime gif, poids < à 20500 octets soit environ 20Ko, largeur = hauteur = 100px
                    //Pour supprimer les espaces dans les noms de fichiers car celà entraîne une erreur lorsque vous voulez l'afficher
                    $fichier = preg_replace("` `i", "", $fichier); //ligne facultative :)
                    //On vérifie s'il existe une image qui a le même nom dans le répertoire
                    if (file_exists('uploads/' . $fichier)) {
                        //Le fichier existe on rajoute dans son nom le timestamp du moment pour le différencier de la première (comme cela on est sûr de ne pas avoir 2 images avec le même nom :) )
                        $nom_final = preg_replace("`.gif`is", date("U") . ".gif", $fichier);
                    } else {
                        $nom_final = $fichier; //l'image n'existe pas on garde le même nom
                    }
                    //on déplace l'image dans le répertoire final
                    move_uploaded_file($tmp, 'uploads/' . $nom_final);
                    //Message indiquant que tout s'est bien passé
                    echo "L'image a été uploadée avec succès<br/>";
                } else {
                    //Le type mime, ou la taille ou le poids est incorrect
                    echo 'Votre image a été rejetée (poids, taille ou type incorrect)';
                }
            }
        }
        //Pour tester si l'image est bien à sa place
        echo '<img src="uploads/' . $nom_final . '" border="0" />';
        echo '<br/>';
        echo '<a href="javascript:history.back();">Retour</a>';
    }
}
