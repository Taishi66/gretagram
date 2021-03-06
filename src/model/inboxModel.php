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
     * Method myDiscussions
     *
     * @param $id_compte $id_compte [explicite description]
     *
     * @return void
     */
    public function myDiscussions($id_compte = null)
    {
        $sql = $this->bdd->prepare('SELECT DISTINCT pseudo,compte.id_compte,photo FROM compte 
                                    INNER JOIN messages ON compte.id_compte = messages.incoming_msg_id
                                    WHERE messages.outgoing_msg_id =:id_compte');
        $sql->execute([
            ':id_compte' => $id_compte
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Method getCompteMessage
     *
     * @param $id_destinataire $id_destinataire [explicite description]
     *
     * @return void
     */
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

    /**
     * Method getCompteMessageSent
     *
     * @param $id_compte $id_compte [explicite description]
     * @param $id_destinataire $id_destinataire [explicite description]
     *
     * @return void
     */
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


    /**
     * Method insertMsg
     *ENVOYER UN MESSAGE
     * @param $incoming_id $incoming_id [receveur]
     * @param $outgoing_id $outgoing_id [expéditeur]
     * @param $msg $msg [le msg en question]
     *
     * @return void
     */
    public function insertMsg($incoming_id = null, $outgoing_id = null, $msg = null)
    {
        $sql = $this->bdd->prepare('INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES(:incoming_msg_id, :outgoing_msg_id, :msg)');
        return $sql->execute([
            ':incoming_msg_id' => $incoming_id,
            ':outgoing_msg_id' => $outgoing_id,
            ':msg' => $msg
        ]);
    }


    /**
     * Method getChat
     *
     * @param $incoming_id $incoming_id [receveur]
     * @param $outgoing_id $outgoing_id [expediteur]
     *
     * @return void
     */
    public function getChat($incoming_id = null, $outgoing_id = null)
    {
        $sql = $this->bdd->prepare('SELECT * FROM messages
                                    INNER JOIN compte ON compte.id_compte = messages.outgoing_msg_id
                                    /*INNER JOIN compte ON compte.id_compte = messages.incoming_msg_id*/
                                    WHERE (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id)
                                    OR (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
                                    ORDER BY msg_id');
        $sql->execute([
            ':incoming_id' => $incoming_id,
            ':outgoing_id' => $outgoing_id
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastMessage($incoming_id = null, $outgoing_id = null)
    {
        $sql = $this->bdd->prepare('SELECT MAX(msg_id) FROM messages
                                    INNER JOIN compte ON compte.id_compte = messages.outgoing_msg_id
                                    WHERE (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id)
                                    OR (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
                                    ORDER BY msg_id');
        $sql->execute([
            ':incoming_id' => $incoming_id,
            ':outgoing_id' => $outgoing_id
        ]);
        return $sql;
    }
}
