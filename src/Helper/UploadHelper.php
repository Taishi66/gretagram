<?php

class UploadHelper
{
    public function upload($media, $user)
    {
        $nomFichier = $_FILES[$media]["name"]; //elephanieeec.jpg
        $trimNomFichier = trim($nomFichier); //supprime les espaces au début et à la fin
        $sanitizedNomFichier = preg_replace('/\s+/', ' ', $trimNomFichier); //Supprime les espaces en milieu de chaine
        $extension = explode(".", $sanitizedNomFichier); // tranforme la chaine decaractere en tableau array()

        $extension = end($extension); // je récupère la dernière donnée du tableau
        $fichierTmp = $_FILES[$media]["tmp_name"];

        // je teste l'extension
        // si different de "true" donc "false" entre dans la condition
        if (!$this->extensionFichier($extension)) {
            error_log("erreur extension");
            return false; // s'il entre dans la condition il s'arrête
        }

        // je teste le mime type
        // si different de "true" donc "false" entre dans la condition
        if (!$this->typeContenuFichier($fichierTmp)) {
            error_log("erreur du mime");
            return false; // si il entre dans la condition il s'arrete
        }

        $nomModifiee = $user . '/' . $sanitizedNomFichier;
        $fichierFinal = "uploads/" . basename($nomModifiee);

        if (move_uploaded_file($fichierTmp, $fichierFinal)) {
            chmod("uploads/" . $nomModifiee, 0777);
            return $fichierFinal;
        } else {
            return false;
        }
    }

    /**
     * Teste l'extension du fichier
     * @param $type le type du fichier image ou cv
     * @param $extension l'extention du fichier qu'on verifie s'il se trouve dans le tableau
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
    public function typeContenuFichier($fichier)
    {
        $aTypeMyme = array('image/png', 'image/jpeg', 'image/gif', 'image/jpg');

        /**
         * mime_content_type($fichier) retourne le type de contenu dans le fichier $fichier
         */
        $mime = mime_content_type($fichier);
        return in_array($mime, $aTypeMyme); // "true" ou "false"
    }
}
