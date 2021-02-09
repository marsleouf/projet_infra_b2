<?php
require_once('../models/user_model.php');

class user_manager
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

    // Fonction d'ajout d'un nouvel utilisateur
    public function addUser(user $user){
        $query = $this->db->prepare("INSERT INTO users(nom, prenom, mail, path_img, mdp) VALUES(:nom, :prenom, :mail, :path_img, :mdp)");

        $query->bindValue(':nom', $user->nom());
        $query->bindValue(':prenom', $user->prenom());
        $query->bindValue(':mail', $user->mail());
        $query->bindValue(':path_img', $user->path_img());
        $query->bindValue(':mdp', $user->mdp());

        $query->execute();
    }

    // Fonction d'update d'un utilisateur par mail
    public function updateUser(user $user, $email){
        $query = $this->db->prepare("UPDATE `users` SET nom =:nom, prenom =:prenom, mail =:mail, mdp =:mdp WHERE users.mail = '$email'");

        $query->bindValue(':nom', $user->nom());
        $query->bindValue(':prenom', $user->prenom());
        $query->bindValue(':mail', $user->mail());
        $query->bindValue(':mdp', $user->mdp());

        $query->execute();
    }

    // Fonction de suppression d'un utilisateur
    public function del_user($id){
       $query = $this->db->prepare("DELETE FROM users WHERE id_user = '$id'");
        
       $query->execute();
    }

    public function getUser($email)
    {

        $query = $this->db->prepare('SELECT * FROM users WHERE mail = :email');
        $query->bindParam(':email', $email);
        $query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);

        if(!empty($donnees)){
            return new user($donnees);
        }else{
            return null;
        }
    }

    // permet de mettre à jour le solde des utilisateur après un paiement
    public function modifySolde(user $user, $id)
    {
        $query = $this->db->prepare("UPDATE `users` SET solde =:solde WHERE users.id_user = '$id'");

        $query->bindValue(':solde', $user->solde());

        $query->execute();
    }
}
?>