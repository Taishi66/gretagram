<?php

class UploadHelper
{

    public function upload($media, $user)
    {

        $nomFichier = $_FILES[$media]["name"]; //elephant.1822636_1920.pdf
        $extension = explode(".", $nomFichier); // tranforme la chaise decaractere en tableau array()

        $extension = end($extension); // je recupere la dernier donnée du tableau 
        $fichierTmp = $_FILES[$media]["tmp_name"];

        // je teste l'extension
        // si different de "true" donc "false" entre dans la condition
        if (!$this->extensionFichier($extension)) {
            echo "erreur du extension";
            return false; // si il entre dans la condition il s'arrete
        }

        // je teste le mime type
        // si different de "true" donc "false" entre dans la condition
        if (!$this->typeContenuFichie($fichierTmp)) {
            echo "erreur du mime";
            return false; // si il entre dans la condition il s'arrete
        }

        $nomModifiee = $user . '/' . $nomFichier . '.' . $extension;
        $fichierFinal = "uploads/" . basename($nomModifiee);

        if (move_uploaded_file($fichierTmp, $fichierFinal)) {
            chmod("uploads/" . $nomFichier, 0777);
            return $fichierFinal;
        } else {
            return false;
        }
    }

    /**
     * Teste l'extension du fichier 
     * @param $type le type du fichier image ou cv
     * @param $extension l'extetion du fichier qu'on verifie si il ce trouve dans le tableau
     */
    public function extensionFichier($extension)
    {
        $aExtension = array("jpg", "png", "jpeg", "gif");
        return in_array($extension, $aExtension); // "true" ou "false"

    }

    /**
     * Teste le type-mime du fichier 
     * @param $type le type du fichier image ou cv
     * @param $typeMime le type-mime du fichier, on verifie si il ce trouve dans le tableau
     */
    public function typeContenuFichie($fichier)
    {
        $aTypeMyme = array('image/png', 'image/jpeg', 'image/gif', 'image/jpg');

        /**
         * mime_content_type($fichier) retourne le type de contenu dans le fichier $fichier
         */
        $mime = mime_content_type($fichier);
        return in_array($mime, $aTypeMyme); // "true" ou "false"

    }
}
