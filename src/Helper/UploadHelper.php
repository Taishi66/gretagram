<?php

class UploadHelper
{
    public function upload($media)
    {
        $nomFichier = $_FILES[$media]["name"]; //elephanieeec.jpg

        $extensionExplosee = explode(".", $nomFichier); // tranforme la chaine decaractere en tableau array()
        $extension = end($extensionExplosee); // je récupère la dernière donnée du tableau

        //remove extension
        $fichierSansExtension = str_replace('.' . $extension, '', $nomFichier);

        $sanitizedNomFichier = $this->sanitize_file_name($fichierSansExtension); //Supprime les espaces et caractère spéciaux 
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
        $fichierFinal = "uploads/" . $sanitizedNomFichier . '.' . $extension;

        if (move_uploaded_file($fichierTmp, $fichierFinal)) {
            return $fichierFinal;
        } else {
            return false;
        }
    }


    function sanitize_file_name($string, $force_lowercase = true, $anal = false)
    {
        $strip = array(
            "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?"
        );
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
            $clean;
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
