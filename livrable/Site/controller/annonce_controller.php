<?php
require_once('../models/annonce_model.php');

class annonce_manager
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

    // Fonction d'ajout d'une nouvelle annonce
    public function addAnnonce(annonce $user){
        $query = $this->db->prepare("INSERT INTO annonces(id_user, titre, description, 
        nb_places, prix, rue, code_postal, numeros, ville, residence, batiment, garage, cuisine_equip, chauffageClim, 
        piscine, maison, etage, superficie, animaux, fumeur, latitude, longitude) 
        VALUES(:id_user, :titre, :description, :nb_places, :prix, :rue, :code_postal, :numeros, :ville, :residence, 
        :batiment, :garage, :cuisine_equip, :chauffageClim, :piscine, :maison, :etage, :superficie, :animaux, 
        :fumeur, :latitude, :longitude )");

        $query->bindValue(':id_user', $user->id_user());
        $query->bindValue(':titre', $user->titre());
        $query->bindValue(':description', $user->description());
        $query->bindValue(':nb_places', $user->nb_places());
        $query->bindValue(':prix', $user->prix());
        $query->bindValue(':rue', $user->rue());
        $query->bindValue(':code_postal', $user->code_postal());
        $query->bindValue(':numeros', $user->numeros());
        $query->bindValue(':ville', $user->ville());
        $query->bindValue(':garage', $user->garage());
        $query->bindValue(':residence', $user->residence());
        $query->bindValue(':batiment', $user->batiment());
        $query->bindValue(':cuisine_equip', $user->cuisine_equip());
        $query->bindValue(':chauffageClim', $user->chauffageClim());
        $query->bindValue(':piscine', $user->piscine());
        $query->bindValue(':maison', $user->maison());
        $query->bindValue(':etage', $user->etage());
        $query->bindValue(':superficie', $user->superficie());
        $query->bindValue(':animaux', $user->animaux());
        $query->bindValue(':fumeur', $user->fumeur());
        $query->bindValue(':latitude', $user->latitude());
        $query->bindValue(':longitude', $user->longitude());
        
        $query->execute();
    }

    // Fonction d'update d'une annonce par son id
    public function updateAnnonce(annonce $user, $id_annonce){
        $query = $this->db->prepare("UPDATE `annonces` SET id_user =: id_user, titre =:titre, description =:description, nb_places =:nb_places, prix =:prix, rue =:rue, code_postal =:code_postal, numeros =:numeros, ville =:ville, residence =:residence, batiment =:batiment, garage =:garage, cuisine_equip =:cuisine_equip, chauffageClim =:chauffageClim, piscine =:piscine, maison =:maison, etage =:etage, superficie =:superficie, animaux =:animaux, fumeur =:fumeur, latitude =:latitude, longitude =:longitude WHERE id_annonce = '$id_annonce'");

        $query->bindValue(':id_user', $user->id_user());
        $query->bindValue(':titre', $user->titre());
        $query->bindValue(':description', $user->description());
        $query->bindValue(':nb_places', $user->nb_places());
        $query->bindValue(':prix', $user->prix());
        $query->bindValue(':rue', $user->rue());
        $query->bindValue(':code_postal', $user->code_postal());
        $query->bindValue(':numeros', $user->numeros());
        $query->bindValue(':ville', $user->ville());
        $query->bindValue(':residence', $user->residence());
        $query->bindValue(':batiment', $user->batiment());
        $query->bindValue(':garage', $user->garage());
        $query->bindValue(':cuisine_equip', $user->cuisine_equip());
        $query->bindValue(':chauffageClim', $user->chauffageClim());
        $query->bindValue(':piscine', $user->piscine());
        $query->bindValue(':maison', $user->maison());
        $query->bindValue(':etage', $user->etage());
        $query->bindValue(':superficie', $user->superficie());
        $query->bindValue(':animaux', $user->animaux());
        $query->bindValue(':fumeur', $user->fumeur());
        $query->bindValue(':latitude', $user->latitude());
        $query->bindValue(':longitude', $user->longitude());

        $query->execute();
    }

    // Fonction de suppression d'une annonce et des photos qui lui correspondent
    public function del_annonce($id){
       $query = $this->db->prepare("DELETE FROM photo WHERE id_annonce = '$id'"); 
       $query2 = $this->db->prepare("DELETE FROM annonces WHERE id_annonce = '$id'");
        
       $query->execute();
       $query2->execute();
    }
}
?>