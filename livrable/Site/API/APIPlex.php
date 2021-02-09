<?php
require("../config/pdo.php");
include_once("../models/user_model.php");
//include_once("C:\xampp\php\PEAR");
// if (!isset($_SESSION['isConnected'])) {
//     //$_SESSION['isConnected'] = FALSE;
//     echo 502;
// } else if ($_SESSION['isConnected']) {
// ALTER TABLE `menu` ADD `azerty` INT NULL AFTER `App`;
// }
try {
//$my_array_data = json_decode($json_string, TRUE);
if (isset($_POST['payload'])){
    //$objet = json_decode($_POST['obj'],JSON_OBJECT_AS_ARRAY);//json_encode($_GET['obj']);
    $query = $pdo->prepare("UPDATE `plexdata` SET `plex`=".json_encode($_POST['payload'])." WHERE 1");
    $query->execute();
    //echo $_GET['obj'];
    //var_dump($_POST['obj']);
}
if (isset($_POST['play'])){
    //$objet = json_decode($_POST['obj'],JSON_OBJECT_AS_ARRAY);//json_encode($_GET['obj']);
    $query = $pdo->prepare("SELECT * FROM `plexdata`");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //echo $_GET['obj'];
    //var_dump($_POST['obj']);
    echo $results[0]['plex'];
}
} catch (\Throwable $th) {
    echo $th;
}


