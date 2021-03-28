  <?php
  include_once('config/pdo.php');
  include_once('models/user_model.php');
  include('models/conSSH.php');
  session_start();

  try {
     //var_dump(intval(htmlspecialchars($_POST['id'])),intval(htmlspecialchars($_POST['idAction'])),intval(htmlspecialchars($_POST['status'])), "            ");
    $curr_user = $_SESSION['user'];
    if (isset($_POST['id']) && $_POST['id'] && isset($_POST['idAction']) && isset($_POST['status'])) {
        //$objres = ;
         echo (ObjectCO($pdo,intval(htmlspecialchars($_POST['id'])),intval(htmlspecialchars($_POST['idAction'])),intval(htmlspecialchars($_POST['status']))));
      }
      if (isset($_GET['AllStatus']) && $_GET['AllStatus']) {
        //$objres = ;
         echo (get_status($pdo,htmlspecialchars($_GET['AllStatus'])));
      }
  } catch (\Throwable $th) {
    echo 0, $th;
  }
  ?>