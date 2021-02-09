<?php
require_once('../models/reservation_model.php');

class reservation_manager
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

    // Fonction d'ajout d'une nouvelle reservation
    public function addResa(reservation $user){
        $query = $this->db->prepare("INSERT INTO reservation(id_user_res, id_user, id_annonce, message, nb_personnes, date_arrivee, date_depart) VALUES(:id_user_res, :id_user, :id_annonce, :message, :nb_personnes, :date_arrivee, :date_depart)");
        
        $query->bindValue(':id_user_res', $user->id_user_res());
        $query->bindValue(':id_user', $user->id_user());
        $query->bindValue(':id_annonce', $user->id_annonce());
        $query->bindValue(':message', $user->message());
        $query->bindValue(':nb_personnes', $user->nb_personnes());
        $query->bindValue(':date_arrivee', $user->date_arrivee());
        $query->bindValue(':date_depart', $user->date_depart());

        $query->execute();
    }

    // Fonction d'update d'une reservation par son id
    public function updateResa(reservation $user, $id_res){
        $query = $this->db->prepare("UPDATE `reservation` SET id_user_res =:id_user_res, id_annonce =:id_annonce, message =:message, nb_personnes =:nb_personnes, date_arrivee =:date_arrivee, date_depart =:date_depart WHERE reservation.id_res = '$id_res'");
        $query->bindValue(':id_user_res', $user->id_user_res());
        $query->bindValue(':message', $user->message());
        $query->bindValue(':nb_personnes', $user->nb_personnes());
        $query->bindValue(':date_arrivee', $user->date_arrivee());
        $query->bindValue(':date_depart', $user->date_depart());

        $query->execute();
    }

    // Fonction de suppression d'un utilisateur
    public function del_Resa($id){
       $query = $this->db->prepare("DELETE FROM reservation WHERE id_res = '$id'");
        
       $query->execute();
    }

    // récupère toutes les réservations qui commencent entre deux dates
    public function getResBetween(DateTime $start, DateTime $end, $id_annonce): array
    {
        $query = $this->db->query("SELECT * FROM reservation WHERE id_annonce = '$id_annonce' AND date_arrivee BETWEEN '{$start->format('Y-m-d')}' AND '{$end->format('Y-m-d')}'");
        $reservations = $query->fetchAll();
        return $reservations;
    }

    // découpe le tableau associatif début de la reservation => fin de la reservation
    public function getStartDay(array $reservations): array
    {
        $dates = [];
        foreach ($reservations as $index=>$value)
        {
            $dates[$value['date_arrivee']] = $value['date_depart'];
        }
        return $dates;
    }
}
?>