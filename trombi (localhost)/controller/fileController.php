<?php

class FileController
{
    public function upload($type, $user)
    {
        switch ($type) {
            case 'image':
                $dossier = "photos/";
                break;
            case 'cv':
                $dossier = "cv/";
                break;
        }
        $nomFichier = $_FILES[$type]["name"];
        $extension = explode(".", $nomFichier);
        $extension = end($extension);
        $fichierTmp = $_FILES[$type]["tmp_name"];


    

        if (!$this->extension($extension, $type)) {
            return false;
        }
        if (!$this->typeContenuFichier($type, $fichierTmp)) {
            echo "jijijijijijiji";
            return false;
        }



        $nomModifiee = $user . '.' . $extension;
        $fichier = $dossier . basename($nomModifiee);

        if (move_uploaded_file($fichierTmp, $fichier)) {
            return $fichier;
        } else {
            echo "Sorry, there was an error uploading your file";
        }
    }

    public function extension($extension, $type)
    {
        switch ($type) {
            case 'image':
                $aExtension = array("jpg", "jpeg", "png", "jpng", "gif");
                break;
            case 'cv':
                $aExtension = array("pdf", "doc");
                break;
        }
        return in_array($extension, $aExtension);
    }


    public function typeContenuFichier($type, $fichier)
    {
        switch ($type) {
            case 'image':
                $aTypeMime = array(
                    'image/png',
                    'image/jpeg',
                    'image/gif',
                    'image/bmp'
                );
                break;
            case 'cv':
                $aTypeMime = array(
                    'application/pdf',
                    'application/mword',
                    'application/vnd.oasis.opendocument.text'
                );
                break;
        }
        return in_array(mime_content_type($fichier), $aTypeMime); //soit true soit false
    }
}
