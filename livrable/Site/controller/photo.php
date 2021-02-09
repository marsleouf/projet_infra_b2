<?php
require_once('../models/photo_model.php');

class photo_manager
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

    // Fonction d'ajout d'une nouvelle photo
    public function addPhoto(photo $user){
        $query = $this->db->prepare("INSERT INTO photo(id_annonce, photo_path) VALUES(:id_annonce, :photo_path)");

        $query->bindValue(':id_annonce', $user->id_annonce());
        $query->bindValue(':photo_path', $user->photo_path());

        $query->execute();
    }

    // Fonction d'update d'une photo par id
    public function updatePhoto(photo $user, $id_photo){
        $query = $this->db->prepare("UPDATE `photo` SET id_annonce =: id_annonce, photo_path =:photo_path WHERE photo.id_res = '$id_photo'");

        $query->bindValue(':id_annonce', $user->id_annonce());
        $query->bindValue(':photo_path', $user->photo_path());

        $query->execute();
    }

    // Fonction de suppression d'une photo
    public function del_photo($id){
       $query = $this->db->prepare("DELETE FROM photo WHERE id_photo = '$id'");
        
       $query->execute();
    }
}
?>