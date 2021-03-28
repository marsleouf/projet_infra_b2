<?php 

class notificaion 
{
    public $results;
    //include('config/pdo.php');
public static function getSQL(){
        private $quey = "SELECT * FROM notification";
        private $query = $pdo->prepare($quey);
        private $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public static function SQLrest(){
        getSQL();
        return $this->results;
    }
}
?>