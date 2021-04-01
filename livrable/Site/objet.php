<?php
include_once('models/user_model.php');
include_once('config/pdo.php');
include('models/conSSH.php');
session_start();
if (!isset($_SESSION['isConnected'])&& !isset($_SESSION['user'])) {
    $_SESSION['isConnected'] = FALSE;
    header('Location: /Dashbord/connect/form_connex.html');
} else if ($_SESSION['isConnected']) {

    $curr_user = $_SESSION['user'];
    $reponse_user = $pdo->query("SELECT * FROM users WHERE mail LIKE '$curr_user->mail'");
    $user = $reponse_user->fetch();
    $image = "/" . substr($user['path_img'], 16);
    include('models/parametreshow.php');
    if (isset($_GET['ip']) && $_GET['ip'] && isset($_GET['ip']) && isset($_GET['port'])&&isset($_GET['type'])) {
        //$objres = ;
         echo (ObjectAjout($pdo,htmlspecialchars($_GET['ip']),intval(htmlspecialchars($_GET['port'])),htmlspecialchars($_GET['name']),htmlspecialchars($_GET['type'])));
      }
}
  //moveFile("menu/App/elec.html","menu/Navigation/elec.html");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Dashboard Objet Connecter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- third party css -->
    <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>
<?php


?>

<body class="loading" id="load" data-layout-config='{
        "leftSideBarTheme":<?php echo $BarTheme ?>,
        "layoutBoxed":<?php echo $Boxed ?>, 
        "leftSidebarCondensed":<?php echo $barCondensed ?>,
        "leftSidebarScrollable":<?php echo $barScrollable ?>, 
        "darkMode":<?php echo $darkMode ?>, 
        "showRightSidebarOnStart": false
    }' data-dark="" data-boxed="<?php echo $Boxed ?>" data-leftbar=<?php echo $BarTheme ?>>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <?php include('html/left-side-menu.php'); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <?php include('html/navbar-custom.php'); ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">

                                </div>
                                <h4 class="page-title">Objet Connecter</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 order-lg-1">
                            <!--Ajouter-->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Ajouter un Objet Connecter</h4>
                                    <form method="GET" action="/Dashbord/objet.php">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-2">
                                            <input class="form-control dropdown-toggle nominput" role="text" name="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Nom de L'objet">
                                            </input>
                                        </div>
                                         <div class="col-xl-3 col-lg-3 row">
                                            <select class="form-control col" name="type" style="width: 60px; height: 35px; margin-right:5px;">
                                                <option>prise</option>
                                                <option>eclairage</option>
                                            </select>    
                                        </div>
                                        <div class="col-xl-2 col-lg-2">
                                            <input class="form-control dropdown-toggle nominput" role="text" name="ip" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="l'addresse IP">
                                            </input>
                                        </div>
                                        <div class="col-xl-1 col-lg-2">
                                            <input class="form-control dropdown-toggle nominput" role="text" name="port" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Le Port">
                                            </input>
                                        </div>
                                        <button class="btn btn-success" type="submit">Ajouter</button>
                                    </div>
                                    </form>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <?php include('html/footer.php'); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar Parametre -->
    <?php include('html/right-bar.php'); ?>

    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->
    <?php include('html/comJs.php'); ?>

    <!-- demo app -->
    <script src="js/parametre.js"></script>
    <!-- end demo js-->
</body>

</html>