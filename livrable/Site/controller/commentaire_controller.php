<?php
require_once('../models/commentaire_model.php');

class com_manager
{
    private $db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    // Fonction d'ajout d'un nouveau commentaire
    public function addCom(com $user){
        $query = $this->db->prepare("INSERT INTO commentaires(id_annonce, commentaire, note) VALUES(:id_annonce, :commentaire, :note)");

        $query->bindValue(':id_annonce', $user->id_annonce());
        $query->bindValue(':commentaire', $user->commentaire());
        $query->bindValue(':note', $user->note());

        $query->execute();
    }

    // Fonction d'update d'un commentaire par id du com (non utilisée sur le site mais disponible pour implémentations futures)
    public function updateCom(com $user, $id_com){
        $query = $this->db->prepare("UPDATE `commentaires` SET id_annonce =: id_annonce, commentaire =:commentaire, note =:note WHERE id_com = '$id_com'");

        $query->bindValue(':id_annonce', $user->id_annonce());
        $query->bindValue(':commentaire', $user->commentaire());
        $query->bindValue(':note', $user->note());

        $query->execute();
    }

    // Fonction de suppression d'un commentaire
    public function del_com($id){
       $query = $this->db->prepare("DELETE FROM commentaires WHERE id_com = '$id'");
        
       $query->execute();
    }
}
?>