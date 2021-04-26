<?php

class UploadHelper
{
    public function upload($media, $user)
    {
        $nomFichier = $_FILES[$type]["name"]; //elephant.1822636_1920.pdf
        $extension = explode(".", $nomFichier); // tranforme la chaise decaractere en tableau array()

        $extension = end($extension); // je recupere la dernier donnée du tableau 
        $fichierTmp = $_FILES[$type]["tmp_name"];

        // je teste l'extension
        // si different de "true" donc "false" entre dans la condition
        if (!$this->extensionFichier($type, $extension)) {
            echo "erreur du extension";
            return false; // si il entre dans la condition il s'arrete
        }

        // je teste le mime type
        // si different de "true" donc "false" entre dans la condition
        if (!$this->typeContenuFichie($type, $fichierTmp)) {
            echo "erreur du mime";
            return false; // si il entre dans la condition il s'arrete
        }

        $nomModifiee = $user . '.' . $extension;
        $target = "uploads/" . basename($nomFichier);


        if (move_uploaded_file($fichierTmp, $target)) {
            return $target;
        } else {
            return false;
        }
    }

    /**
     * Teste l'extension du fichier 
     * @param $type le type du fichier image ou cv
     * @param $extension l'extetion du fichier qu'on verifie si il ce trouve dans le tableau
     */
    public function extensionFichier($type, $extension)
    {
        switch ($type) {
            case 'image':
                $aExtension = array("jpg", "png", "jpeg", "gif");
                break;
            case 'cv':
                $aExtension = array("pdf", "doc", "odt");
                break;
        }
        /**
         * in_array() verifie si une donnée se trouve dans le tableau
         * elle retoure soit "true" soit "false"
         * @param $extension = donnée
         * @param $aExtension = tableau array()
         */
        return in_array($extension, $aExtension); // "true" ou "false"

    }

    /**
     * Teste le type-mime du fichier 
     * @param $type le type du fichier image ou cv
     * @param $typeMime le type-mime du fichier, on verifie si il ce trouve dans le tableau
     */
    public function typeContenuFichie($type, $fichier)
    {
        switch ($type) {
            case 'image':
                $aTypeMyme = array('image/png', 'image/jpeg', 'image/gif', 'image/bmp');
                break;
            case 'cv':
                $aTypeMyme = array('application/pdf', 'application/msword');
                break;
        }
        /**
         * mime_content_type($fichier) retourne le type de contenu dans le fichier $fichier
         */
        $mime = mime_content_type($fichier);
        return in_array($mime, $aTypeMyme); // "true" ou "false"

    }
}


/*
$test = new FileController();

if ($test->extension('jpg', 'image')) {
    echo "OK";
} else {
    echo "KO";
}
 */
