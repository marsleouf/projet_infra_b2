  <?php
  include_once('config/pdo.php');
  include_once('models/user_model.php');
  session_start();
  $Boxed = 0; // menu decaler
  $bar = ""; //minimaze
  $BarTheme = "";
  $darkMode = 0; //drak mode totale

  try {
    $curr_user = $_SESSION['user'];
    if (isset($_POST['mode']) && $_POST['mode'] == "1") {
      if (isset($_POST['bartheme']) && $_POST['bartheme']) {
        $BarTheme = htmlspecialchars($_POST['bartheme']);
      }
      if (isset($_POST['darkmode']) && $_POST['darkmode']) {
        $darkMode = htmlspecialchars($_POST['darkmode']);
      }
      if (isset($_POST['menudecaler']) && $_POST['menudecaler']) {
        $Boxed = htmlspecialchars($_POST['menudecaler']);
      }
      if (isset($_POST['bar']) && $_POST['bar']) {
        $bar = htmlspecialchars($_POST['bar']);
      }
      $quey = "UPDATE parametre SET bar_theme='" . $BarTheme . "',darkmode='" . $darkMode . "',menu_decaler='" . $Boxed . "',bar='" . $bar . "' WHERE id_user = $curr_user->id_user";
      $query = $pdo->prepare($quey);
      $query->execute();

      echo 1;
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "2") {
      if (isset($_POST['color1']) && $_POST['color1']) {
        $color1 = htmlspecialchars($_POST['color1']);
      }
      if (isset($_POST['color2']) && $_POST['color2']) {
        $color2 = htmlspecialchars($_POST['color2']);
      }
      $quey = "UPDATE parametre SET color1='" . $color1 . "',color2='" . $color2 . "' WHERE id_user = $curr_user->id_user";
      $query = $pdo->prepare($quey);
      $query->execute();
      echo 1;
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "3") {
      if (isset($_POST['color3']) && $_POST['color3']) {
        $color3 = htmlspecialchars($_POST['color3']);
      }
      if (isset($_POST['color4']) && $_POST['color4']) {
        $color4 = htmlspecialchars($_POST['color4']);
      }
      $quey = "UPDATE parametre SET color3='" . $color3 . "',color4='" . $color4 . "' WHERE id_user = $curr_user->id_user";
      $query = $pdo->prepare($quey);
      $query->execute();
      echo 1;
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "4") {
      if (isset($_POST['color5']) && $_POST['color5']) {
        $color5 = htmlspecialchars($_POST['color5']);
      }
      if (isset($_POST['color6']) && $_POST['color6']) {
        $color6 = htmlspecialchars($_POST['color6']);
      }
      $quey = "UPDATE parametre SET color5='" . $color5 . "',color6='" . $color6 . "' WHERE id_user = $curr_user->id_user";
      $query = $pdo->prepare($quey);
      $query->execute();
      echo 1;
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "5") {
      if (isset($_POST['nom']) && $_POST['nom']) {
        $quey = "SELECT * FROM `donner_insee` WHERE `nom` LIKE '" . htmlspecialchars($_POST['nom']) . "%'";
        $query = $pdo->prepare($quey);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results, JSON_PRETTY_PRINT);
        echo $json;
      }
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "6") {
      if (isset($_POST['id']) && $_POST['id']) {
        $quey = "SELECT * FROM `donner_insee` WHERE  `id_insee` = '" . htmlspecialchars($_POST['id']) . "'";
        $query = $pdo->prepare($quey);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results, JSON_PRETTY_PRINT);
        echo $json;
      }
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "7") {
      if (isset($_POST['nom']) && isset($_POST['codeDepartement']) && isset($_POST['codesPostaux']) && isset($_POST['insee'])) {
        $quey = "UPDATE parametremeteo SET nom='" . htmlspecialchars($_POST['nom']) . "',codeDepartement='" . htmlspecialchars($_POST['codeDepartement']) . "',codesPostaux='" . htmlspecialchars($_POST['codesPostaux']) . "',insee='" . htmlspecialchars($_POST['insee']) . "' WHERE id_meteo = 1";
        $query = $pdo->prepare($quey);
        $query->execute();
      }
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "8") {
      $quey = "SELECT * FROM `parametremeteo` WHERE  `id_meteo` = 1";
      $query = $pdo->prepare($quey);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      $json = json_encode($results, JSON_PRETTY_PRINT);
      echo $json;
    }
    if (isset($_POST['mode']) && $_POST['mode'] == "9") {
      if (isset($_POST['color7']) && $_POST['color7']) {
        $color7 = htmlspecialchars($_POST['color7']);
      }
      if (isset($_POST['color8']) && $_POST['color8']) {
        $color8 = htmlspecialchars($_POST['color8']);
      }
      $quey = "UPDATE parametre SET color7='" . $color7 . "',color8='" . $color8 . "' WHERE id_user = $curr_user->id_user";
      $query = $pdo->prepare($quey);
      $query->execute();
      echo 1;
    }
    
  } catch (\Throwable $th) {
    echo 0, $th;
  }
  ?>