<?php
require("../config/pdo.php");
//include_once("C:\xampp\php\PEAR");
if (session_id() == '') {
    session_start();
}
function dateDifference($date_1, $date_2, $differenceFormat = '%a')
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    $interval = date_diff($datetime1, $datetime2);
    return $interval->format($differenceFormat);
}
function UPDATEbasse(
    $pdo,
    $insee
) {
    $query = $pdo->prepare("SELECT * FROM `objetmeteo`");
    $query->execute();
    $resultsObjetMeteoCity = $query->fetchAll(PDO::FETCH_ASSOC);
    $varObjetCity = json_decode($resultsObjetMeteoCity[0]["city"], true);
    $varObjetDate = date($resultsObjetMeteoCity[0]["date"]);
    
    $query = $pdo->prepare("SELECT nom FROM `parametremeteo`");
    $query->execute();
    $resultsCity = $query->fetchAll(PDO::FETCH_ASSOC);

    $newdate = new DateTime();
    $newdate = $newdate->format('Y-m-d\TH:i:s.u');
    $datedeffMin = intval(dateDifference($newdate, $varObjetDate, '%i'));
    $datedeffJOUR = intval(dateDifference($newdate, $varObjetDate, '%d'));
    

    if ($datedeffMin > 10 || $datedeffJOUR != 0 || $varObjetCity["name"] !== $resultsCity[0]["nom"]) {
        $api = new ApiMeteo();
        $api->Get($insee);
        $valueApi = $api->get_ressut();
        $forecast = $valueApi["forecast"];
        $city = $valueApi["city"];
        $ephemeride = $valueApi["ephemeride"];
        $query = $pdo->prepare("UPDATE `objetmeteo` SET `city`='".json_encode($city)."', `ephemeride`='".json_encode($ephemeride)."', `forecast`='".json_encode($forecast)."', `date`='".$newdate."'");
        $query->execute();
    }

    $arrayTotal=[];
    $query = $pdo->prepare("SELECT * FROM `objetmeteo`");
    $query->execute();
    $resultsobjetmeteo = $query->fetchAll(PDO::FETCH_ASSOC);

    $arrayTotal['city'] = json_decode( $resultsobjetmeteo[0]['city'], JSON_OBJECT_AS_ARRAY);
    $arrayTotal['ephemeride'] = json_decode( $resultsobjetmeteo[0]['ephemeride'], JSON_OBJECT_AS_ARRAY);
    $arrayTotal['forecast'] = json_decode( $resultsobjetmeteo[0]['forecast'], JSON_OBJECT_AS_ARRAY);
    return json_encode($arrayTotal);
}
class ApiMeteo
{
    private static $apikey = "?token=499f489bf9d0e41b8535c55a6396880923a99780eb27a0231173f2000e12f006";
    private static $Url = "https://api.meteo-concept.com/api/forecast/daily";
    private static $jour = 0;
    private static $Url1 = "https://api.meteo-concept.com/api/ephemeride/";
    private static $Ressut = array();
    private static $dec;
    public function convertJson()
    {
        return json_encode(self::$Ressut);
    }
    public function Get($insee)
    {
        $resulget = file_get_contents(self::$Url . self::$apikey . "&insee=" . $insee);
        $resulget1 = file_get_contents(self::$Url1 . self::$jour . self::$apikey . "&insee=" . $insee);
        $decoded = json_decode($resulget, JSON_OBJECT_AS_ARRAY);
        $decoded1 = json_decode($resulget1, JSON_OBJECT_AS_ARRAY);
        $decoded["ephemeride"] = $decoded1["ephemeride"];
        self::$Ressut = $decoded;
    }
    public function get_ressut()
    {
        return self::$Ressut;
    }
}

$api = new ApiMeteo();

try {
    //$curr_user = $_SESSION['user'];
    $quey = "SELECT * FROM `parametremeteo` WHERE id_meteo = 1";
    $query = $pdo->prepare($quey);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $insee = $results[0]["insee"];
    // $insee = "33063";

    if (isset($_GET['ME']) && $_GET['ME'] == "1") {
        
        echo UPDATEbasse($pdo,$insee);
        //echo $api->convertJson();
    }
    if (isset($_GET['ME']) && $_GET['ME'] == "2") {
        UPDATEbasse($pdo,$insee);
        $query = $pdo->prepare("SELECT forecast FROM `objetmeteo`");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = json_decode($result[0]['forecast'],JSON_OBJECT_AS_ARRAY);
        //var_dump($result);
        $arraySoleil = [];
        $arrayPluie = [];
        $arrayDay = [];
        $arrayTotal = [];
        $arrayPluieMax = [];
        //echo json_encode($result);
        foreach ($result as $value) {
            array_push($arraySoleil, intval($value["sun_hours"]));
            array_push($arrayPluie, intval($value["rr10"]));
            array_push($arrayPluieMax,intval($value["rr1"]));
            //$date = date_create();
            array_push($arrayDay,$value["datetime"]);
        }
        //var_dump($arraySoleil);
        $arrayTotal["sun_hours"] = $arraySoleil;
        $arrayTotal["rr10"] = $arrayPluie;
        $arrayTotal["rr1"] = $arrayPluieMax;
        $arrayTotal["day"] = $arrayDay;
        
        //UPDATEbasse($pdo, $api->get_ressut());
        echo json_encode($arrayTotal);
    }
} catch (\Throwable $th) {
    echo 0, $th;
}
