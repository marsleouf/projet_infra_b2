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
function objectToJSON($object) {
 $properties = get_object_vars($object);
 foreach($properties as &$value){
    if(is_object($value) && method_exists($value,'getJsonData')){
        $value = $value->getJsonData();
    }
 }
 return json_encode($properties);
}
function convertArray($objet){
    //var_dump(explode("t:{", $objet));
    // for(){

    // }
    //objectToJSON($object);
    $value = str_replace("{","[",$objet);
    $value1 = str_replace(":","]=>",$value);
    //$value2 = str_replace('"',"",$value1);
    //$value2 = str_replace(
    $value3 = str_replace(',',",[",$value1);
    $value4 = str_replace("}","]",$value3);
    parse_str($objet,$myarray);
    return $value4 ;
}

$objet;

$array1 = ["dash.html","elec.html"];
$array2 = ["meteo.html"];
try {
//$my_array_data = json_decode($json_string, TRUE);
    if (isset($_GET['ME']) && $_GET['ME'] == "1") {
        $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user = ".$_GET['ME']);
        $query->execute();
        $MenuObjet = $query->fetchAll(PDO::FETCH_ASSOC);
        //convertArray($objet);
        $jsonencoded = json_decode($MenuObjet[0]["menu"], true);
        //var_dump(json_decode($jsonencoded[0]['id_user'],JSON_OBJECT_AS_ARRAY));
        var_dump($jsonencoded);
    }
    if (isset($_POST['obj']) && $_POST['mode'] == "2"){
        //$objet = json_decode($_POST['obj'],JSON_OBJECT_AS_ARRAY);//json_encode($_GET['obj']);
        $query = $pdo->prepare("UPDATE `menu` SET `menu`='".$_POST['obj']."'WHERE id_user = 1");
        $query->execute();
        echo $_POST['obj'];
        //var_dump($_POST['obj']);
    }
    if (isset($_GET['ME']) && $_GET['ME'] == "2") {
        $arrayFile=[];
        $valut = scandir("../menu");
        array_shift($valut);
        array_shift($valut);
        foreach ($valut as $value){
            $restFile = scandir("../menu/".$value);
            array_shift($restFile);
            array_shift($restFile);
            $arrayFile[$value] = $restFile;
        }
        foreach($arrayFile as $key => $value){
            $query = $pdo->prepare("UPDATE `menu` SET `".$key."` ='".implode(",",$value)."' WHERE id_user = 1");
            $query->execute();
        }
    }
    if (isset($_GET['ME']) && $_GET['ME'] == "3") {
        $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user = 1");
        $query->execute();
        $MenuObjet = $query->fetchAll(PDO::FETCH_ASSOC);
        //convertArray($objet);
        //$jsonencoded = json_decode($MenuObjet[0]["menu"], true);
        //var_dump(json_decode($jsonencoded[0]['id_user'],JSON_OBJECT_AS_ARRAY));
        echo $MenuObjet[0]["menu"];///json_encode($MenuObjet[0]["menu"]); 
    }
    if (isset($_GET['ME']) && $_GET['ME'] == "4") {
        $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user = 1");
        $query->execute();
        $MenuObjet = $query->fetchAll(PDO::FETCH_ASSOC);
        //convertArray($objet);
        //$jsonencoded = json_decode($MenuObjet[0]["menu"], true);
        //var_dump(json_decode($jsonencoded[0]['id_user'],JSON_OBJECT_AS_ARRAY));
        $obj = explode(",",$MenuObjet[0]["Navigation"]); 
        var_dump($obj); ///json_encode($MenuObjet[0]["menu"]); 
        }
    } catch (\Throwable $th) {
        echo $th;
    }


