<?php

   $quey = "SELECT * FROM parametre WHERE id_user = '$curr_user->id_user'";
    $query = $pdo->prepare($quey);
    $query->execute();
    $parametre = $query->fetchAll(PDO::FETCH_ASSOC);

  
    $color1 = "#31f500";
    $color2 = "#ffbc00";
    $color3 = "#31f500";
    $color4 = "#ffbc00";
    $color5 = "#31f500";
    $color6 = "#ffbc00";
    $color7 = "#31f500";
    $color8 = "#ffbc00"; 
    $barScrollable = "";
     $barCondensed = "";
    $Boxed="";

    foreach($parametre as $value){
        $BarTheme = '"'.$value['bar_theme'].'"'; //dark or light or default of menu
        if ($value['menu_decaler']){
            $Boxed = htmlspecialchars($value['menu_decaler']); // menu decaler
        }
        if($value['bar']=="condensed"){
            $barCondensed ="true"; //minimaze
            $barScrollable ="false"; 
        }
        if($value['bar']=="fixed"){
            $barCondensed ="false"; //minimaze
            $barScrollable ="false"; 
        }
        if($value['bar']=="scrollable"){
            $barCondensed ="false"; //minimaze
            $barScrollable ="true"; 
        }
        if($value['darkmode']){
            $darkMode = htmlspecialchars($value['darkmode']) ; //drak mode totale
        }
        $color1 = $value['color1'];
        $color2 = $value['color2']; 
        $color3 = $value['color3'];
        $color4 = $value['color4']; 
        $color5 = $value['color5'];
        $color6 = $value['color6']; 
        $color7 = $value['color7'];
        $color8 = $value['color8']; 
    }
    ?>