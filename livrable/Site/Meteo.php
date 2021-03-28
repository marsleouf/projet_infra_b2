<?php
include_once("models/user_model.php");
include_once("config/pdo.php");
//include_once("API/APIMeteo.php");
//$apimeteo = new APIMeteo;
session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = FALSE;
    header('Location: /Dashbord/connect/form_connex.html');
} else if ($_SESSION['isConnected']) {
    try {
        $curr_user = $_SESSION['user'];
        $reponse_user = $pdo->query("SELECT * FROM users WHERE mail LIKE '$curr_user->mail'");
        $user = $reponse_user->fetch();
        $image = "/" . substr($user['path_img'], 16);
    } catch (\Throwable $th) {
        echo 0;
    }

   include('models/parametreshow.php');
}

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
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
    }' data-dark="" data-boxed="<?php echo $Boxed ?>" data-leftbar=<?php echo $BarTheme ?> onload="initmeteo();">
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
                        <div class="col-8">
                            <div class="page-title-box">
                                <h4 class="page-title">Meteo</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 order-lg-12">
                        <!--Cecle 1-->
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="TitelMeteo">
                                    <div class="text-center col-xl-12 col-lg-12">
                                        <div class="spinner-grow text-success" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="idmeteo">
                    </div>
                    <div class="progress-circle">
                    </div>
                    <!-- end col -->
                    <?php //print("Le week-end prochain est dans {$saturday} jours ! Les températures mini/maxi à {$city->name} seront :\n");
                    //print("\tSamedi   : {$forecasts[$saturday]->tmin}°C/{$forecasts[$saturday]->tmax}°C\n");
                    //print("\tDimanche : {$forecasts[$saturday+1]->tmin}°C/{$forecasts[$saturday+1]->tmax}°C\n");
                    //var_dump($apimeteo->get());
                    ?>

                    <div class="row">
                    </div>
                    <!-- end page title -->
                    <div class="row">
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                </div>
                <!-- end row -->
            </div>
            <div id='atmogramme'></div>
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
    <script src="js/meteo.min.js"></script>
    <script src="js/meteo.js"></script>
    <!-- end demo js-->
</body>

</html>