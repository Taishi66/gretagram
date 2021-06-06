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

    public function seeInbox($id_compte = null)
    {
        $sql = $this->bdd->prepare('SELECT * FROM compte WHERE id_compte=:id_compte');
        $sql->execute([
            ':id_compte' => $id_compte
        ]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seeDiscussion($id_destinataire = null)
    {
        $sql = $this->bdd->query('SELECT contenu_message FROM inbox WHERE id_destinataire =:id_destinataire');
        $resultat = $sql->execute([
            ':id_destinataire' => $id_destinataire
        ]);
        return $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
}
