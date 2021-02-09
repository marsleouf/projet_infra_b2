<?php
  include_once('config/pdo.php');
  include_once('models/user_model.php');
  session_start();

  try {
    $curr_user = $_SESSION['user'];
    //$ip = "193.250.53.76";
    $ip = "192.168.1.101";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch,CURLOPT_URL,"http://".$ip.":5000/infobat");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
    $data = curl_exec($ch);
    curl_close($ch);
    echo $data;
    $data = "";
  } catch(\Throwable $th){
    echo 0;
  }
