<?php
  include_once('config/pdo.php');
  include_once('models/user_model.php');
  session_start();

   try {
    $curr_user = $_SESSION['user'];
    if (isset($_POST['mode']) && $_POST['mode'] == "1"){
      $quey = "SELECT * FROM notification";
      $query = $pdo->prepare($quey);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($results,JSON_PRETTY_PRINT);
      echo $json;
    }
  } catch (\Throwable $th) {
    echo 0;
  } 
    ?>