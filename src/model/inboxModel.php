<?php

class InboxModel
{
    private $bdd = null;


    public function __construct()
    {
        $this->bdd = Bdd::Connexion();
    }

    /**
     * Method sendMessage
     *
     * @param $contenu_message $contenu_message [le message]
     * @param $id_compte $id_compte [id du compte qui envoie]
     * @param $id_destinataire $id_destinataire [id du compte qui reçoit]
     *
     * @return void
     */
    public function sendMessage($contenu_message = null, $id_compte = null, $id_destinataire = null)
    {
        $sql = $this->bdd->prepare('INSERT INTO inbox(contenu_message, id_compte, id_destinataire) 
                                    VALUES (:contenu_message, :id_compte, :id_destinataire)');
        return $sql->execute([
            ':contenu_message' => $contenu_message,
            ':id_compte' => $id_compte,
            ':id_destinataire' => $id_destinataire
        ]);
    }

    /**
     * Method getConversation
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */

    /**
     * Method myDiscussions
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    public function myDiscussions($id_compte = null)
    {
        $sql = $this->bdd->prepare('SELECT DISTINCT pseudo,compte.id_compte,photo FROM compte 
                                    INNER JOIN inbox ON compte.id_compte = inbox.id_destinataire
                                    WHERE inbox.id_compte =:id_compte');
        $sql->execute([
            ':id_compte' => $id_compte
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompteMessage($id_destinataire = null)
    {
        $sql = $this->bdd->prepare('SELECT compte.*,inbox.* FROM compte
                                    INNER JOIN inbox ON inbox.id_destinataire = compte.id_compte
                                    WHERE inbox.id_destinataire = :id_destinataire');
        $sql->execute([
            ':id_destinataire' => $id_destinataire
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompteMessageSent($id_compte = null, $id_destinataire = null)
    {
        $sql = $this->bdd->prepare('SELECT * FROM inbox
                                    INNER JOIN compte ON compte.id_compte = inbox.id_compte 
                                    WHERE (inbox.id_compte =:id_compte AND inbox.id_destinataire=:id_destinataire)
                                    OR (inbox.id_compte =:id_destinataire AND inbox.id_destinataire=:id_compte)
                                    ORDER BY date_message DESC ');
        $sql->execute([
            ':id_compte' => $id_compte,
            ':id_destinataire' => $id_destinataire
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
