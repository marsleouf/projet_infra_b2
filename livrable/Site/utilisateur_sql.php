
<?php
include_once('config/pdo.php');
include_once('models/user_model.php');
session_start();
function moveFile($dossierSource , $dossierDestination){
  $retour = 1; 
  if(!file_exists($dossierSource)) { 
   $retour = -1; 
  } else { 
   if(!copy($dossierSource, $dossierDestination)) { 
   $retour = -2; 
   } else { 
    if(!unlink($dossierSource)) { 
    $retour = -3; 
    } 
   } 
  } 
  return($retour);
 }
  function HeadDatatoValue($pdo,$user,$Colone,$UL)
    {
      $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user =".htmlspecialchars($user));
      $query->execute();
      $res = $query->fetchAll(PDO::FETCH_ASSOC);
     
        foreach($res[0] as $keyData => $valueData){
            if($keyData != "id_menu" && $keyData != "id_user"){
               if($Colone == $keyData){
                $obj = explode(",",$res[0][$keyData]);
                array_push($obj,$UL);
                var_dump($obj, implode(",",$obj));
                $query = $pdo->prepare("UPDATE `menu` SET `".$keyData."` ='".implode(",",$obj)."' WHERE id_user =".htmlspecialchars($user));
                $query->execute();
              }
            }
        }
    }
     function HeadDatatoValueDEL($pdo,$user,$Colone,$UL)
    {
      $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user =".htmlspecialchars($user));
      $query->execute();
      $res = $query->fetchAll(PDO::FETCH_ASSOC);
     
        foreach($res[0] as $keyData => $valueData){
            if($keyData != "id_menu" && $keyData != "id_user"){
               if($Colone == $keyData){
                $obj = explode(",",$res[0][$keyData]);
                unset($obj[array_search($UL, $obj)]);
                var_dump($obj, implode(",",$obj));
                $query = $pdo->prepare("UPDATE `menu` SET `".$keyData."` ='".implode(",",$obj)."' WHERE id_user =".htmlspecialchars($user));
                $query->execute();
              }
            }
        }
    }

try {
   if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected'] = FALSE;
   header('Location: /Dashbord/connect/form_connex.html');
   }else {
      $curr_user = $_SESSION['user'];
      $reponse_user = $pdo->query("SELECT type FROM users WHERE mail LIKE '$curr_user->mail'");
      $user = $reponse_user->fetch();
      if($user["type"] == "admin"){
      $_RequeteMET = $_SERVER['REQUEST_METHOD'];
      $_ValueHead = getallheaders();
      if ($_RequeteMET != "GET" && $_RequeteMET != "POST") {
        $data4 = $_ValueHead['Data'];
        $data1 = explode("&", $data4);
        $_RequeteHead = [];
        foreach($data1 as $data2){
          $data3 = explode("=", $data2);
          $_RequeteHead[htmlspecialchars($data3[0])] = htmlspecialchars($data3[1]);
        }
        $_RequeteHead;
      }
      // $output = shell_exec('systemctl status nginx 2>&1');
      // var_dump($output);
      
      //var_dump($_RequeteMET ,HeadDatatoValue('Data'));
      if (isset($_POST['mode']) && $_POST['mode'] == 0){ //ajouter
        $curr_user = $_SESSION['user'];
        if(isset($_POST['nom']) && $_POST['nom']){
          $nom = htmlspecialchars($_POST['nom']);
        }
        if(isset($_POST['prenom']) && $_POST['prenom']){
          $prenom = htmlspecialchars($_POST['prenom']);
        }
        if(isset($_POST['mail']) && $_POST['mail']){
          $mail = htmlspecialchars($_POST['mail']);
        }
        if(isset($_POST['mdp']) && $_POST['mdp']){
          $mdp = htmlspecialchars($_POST['mdp']);
        }
        if(isset($_POST['type']) && $_POST['type']){
          $type = htmlspecialchars($_POST['type']);
        }
        
        $quey = "INSERT INTO users(nom, prenom, 
        mail, mdp, type) VALUES('".$nom."','". $prenom."','".$mail."','".$mdp."','".$type."')";
        $query = $pdo->prepare($quey);
        $query->execute();

        $quey1 = "SELECT id_user FROM users WHERE mail = '".$mail."'";
        $query1 = $pdo->prepare($quey1);
        $query1->execute();
        $result = $query1->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $value){ $id = $value['id_user'];}

        $quey2 = "INSERT INTO parametre(id_user, bar_theme, 
        darkmode, menu_decaler, bar,color1,color2,color3,color4,color5,color6) VALUES(".$id.",'dark','1','0','fixed','#0cd301','#ff040b','#1401c0','#3fd1eb','#f3b907','#fffb00')";
        $query2 = $pdo->prepare($quey2);
        $query2->execute();
        $query2 = $pdo->prepare("INSERT INTO `menu`(`id_user`) VALUES (".$id.")");
        $query2->execute();
        echo 1;
      }
      if (isset($_POST['mode']) && $_POST['mode'] == 1){ //modifier

        $curr_user = $_SESSION['user'];
        if(isset($_POST['id']) && $_POST['id']){
          $id = htmlspecialchars($_POST['id']);
        }
        if(isset($_POST['nom']) && $_POST['nom']){
          $nom = htmlspecialchars($_POST['nom']);
        }
        if(isset($_POST['prenom']) && $_POST['prenom']){
          $prenom = htmlspecialchars($_POST['prenom']);
        }
        if(isset($_POST['mail']) && $_POST['mail']){
          $mail = htmlspecialchars($_POST['mail']);
        }
        if(isset($_POST['mdp']) && $_POST['mdp']){
          $mdp = htmlspecialchars($_POST['mdp']);
        }
        if(isset($_POST['type']) && $_POST['type']){
          $type = htmlspecialchars($_POST['type']);
        }
        
        $quey4 = "UPDATE users SET nom='".$nom."',prenom='". $prenom."',mail='".$mail."',mdp='".$mdp."',type='".$type."' WHERE id_user = ".$id."";
        $query = $pdo->prepare($quey4);
        $query->execute();
        echo 1;
      }
      if (isset($_POST['mode']) && $_POST['mode'] == 2){ //selct

        $curr_user = $_SESSION['user'];
        if(isset($_POST['id']) && $_POST['id']){
          $id = htmlspecialchars($_POST['id']);
        }
        
        $quey = "SELECT * FROM users WHERE id_user = '".$id."'";
        $query = $pdo->prepare($quey);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results,JSON_PRETTY_PRINT);
        echo $json;
        echo "  ". 1;
      }
      if (isset($_POST['mode']) && $_POST['mode'] == 3){ //DEL

        $curr_user = $_SESSION['user'];
        if(isset($_POST['id']) && $_POST['id']){
          $id = htmlspecialchars($_POST['id']);
        }
        $quey4 = "DELETE FROM users WHERE id_user = ".$id."";
        $query = $pdo->prepare($quey4);
        $query->execute();
        $query = $pdo->prepare("DELETE FROM menu WHERE id_user = ".$id."");
        $query->execute();
        $query = $pdo->prepare("DELETE FROM parametre WHERE id_user = ".$id."");
        $query->execute();
        echo "  ". 1;
      }
      if (isset($_POST['searcheUser']) || $_RequeteMET){ // control menu
          if(isset($_DELETE['id']) && $_DELETE['id'] != ""){
          }
          if(isset($_POST['AjouterColoneName']) && $_POST['AjouterColoneName'] != ""){// Aju Colone
            $arr = [];
            if (isset($_POST['AjouterColoneName'])){
              try {
                $query = $pdo->prepare("ALTER TABLE `menu` ADD `".htmlspecialchars($_POST['AjouterColoneName'])."` MEDIUMTEXT NULL");
                $query->execute();
                $arr["state"] = "successful";
                echo json_encode($arr);
              } catch (\Throwable $th) {
                $arr["state"] = "error";
                echo json_encode($arr);
              } 
            }
          }
          if(isset($_RequeteMET) && $_RequeteMET == "DELETE"){ // Sup Colone
            //var_dump($_RequeteHead);
            try {
              $arr1;
              $query = $pdo->prepare("ALTER TABLE `menu` DROP `".htmlspecialchars($_RequeteHead['DelletAjouterColoneName'])."`");
              $query->execute();
              $arr1["state"] = "successful";
                echo json_encode($arr1);
            } catch (\Throwable $th){
                $arr1["state"] = "error";
                echo json_encode($arr1);
            }
          }
          if(isset($_RequeteMET) && $_RequeteMET == "SHOW"){ // Show menu select of user
            $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user =".htmlspecialchars($_RequeteHead['searcheUser']));
            $query->execute();
            $MenuObjet = $query->fetchAll(PDO::FETCH_ASSOC);
            if($MenuObjet != null){
              foreach ($MenuObjet[0] as $key => $value){
                if ($key != "id_menu" && $key != "id_user"){
                  if($value != ""){
                    ?>
                    <il class="side-nav-title side-nav-item"><?php echo $key; ?></il>
                      <?php
                    $obj = explode(",",$MenuObjet[0][$key]);
                      foreach ($obj as $value2){
                        if ($value2 != ""){
                          include('menu/'.$value2); 
                        }
                      }
                    }
                  }
                }
              }
            //var_dump($MenuObjet[0]);
            //echo $MenuObjet;
          }
          if (isset($_RequeteMET) && $_RequeteMET == "ADDFIL"){
            HeadDatatoValue($pdo,$_RequeteHead['searcheUser'],$_RequeteHead['ColoneName'],$_RequeteHead['FileName']);
          }
          if (isset($_RequeteMET) && $_RequeteMET == "DELFIL"){
            HeadDatatoValueDEL($pdo,$_RequeteHead['searcheUser'],$_RequeteHead['ColoneName'],$_RequeteHead['FileName']);
          }
      }
    }else {
     $arr["state"] = "error: Not admin";
      echo json_encode($arr);
    }
  }
} catch (\Throwable $th) {
  echo 0;
  echo $quey4;
}

?>