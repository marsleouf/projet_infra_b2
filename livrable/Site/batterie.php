<?php
    include_once('models/user_model.php');
    include_once('config/pdo.php');
    session_start();
    if (!isset($_SESSION['isConnected'])){
        $_SESSION['isConnected'] = FALSE;
        header('Location: /Dashbord/connect/form_connex.html');
    }else if($_SESSION['isConnected']){

    $curr_user = $_SESSION['user'];
    $reponse_user = $pdo->query("SELECT * FROM users WHERE mail LIKE '$curr_user->mail'");
    $user = $reponse_user->fetch();
    $image = "/".substr($user['path_img'],16);

  include('models/parametreshow.php');
    }
    
?>
 <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <link rel="shortcut icon" href="images/favicon.ico">
<!-- third party css end -->
   <!-- App favicon -->
  
<!-- third party css -->
<link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->

<!-- App css -->

<link href="css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
<link href="css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

<link href="css/batterie.css" rel="stylesheet" type="text/css" />
<link href="css/temp.css" rel="stylesheet" type="text/css" />
        
       
        
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>
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
                                    <h4 class="page-title">Stocages et Production</h4>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-6 order-lg-3">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class=" col-xl-11 col-lg-11 col-sm-11">
                                                <div class="page-title-box">
                                                    <h4 class="page-title">Batterie<span id="affiche"></span></h4>
                                                </div>
                                            </div>
                                            <input value=3 class="form-control form-control-sm col-xl-1 col-lg-1 col-sm-1" type="number" max=60 min=0 id="NBse">
                                        </div>
                                        <div class="row" id="batt">
                                            <!--<div class="col-xl-4 col-lg-6 order-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="progress progress-bar-vertical" style="width: 50%; ">
                                                            <div class="progress-bar" style="height: 50%; background-color: rgb(0, 26, 255);"> 50 °C</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-6 order-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="page-title-box">
                                                    <h4 class="page-title">Production</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="prod">

                                            <div class="col-xl-12 col-lg-6 order-lg-3">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <div class="row"><!--Titre-->
                                                            <div class="col-12">
                                                                <div class="page-title-box">
                                                                    <h4 class="page-title">Groupe l'electrogene</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <img class="col-sm-3" src="images/unnamed.png"></img>
                                                            <span class="col-sm-1"></span>
                                                            <img class="col-sm-3" src="images/unnamed.png"></img>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </div>
                                </div>
                            </div>

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
        
        <script src="js/batterie.min.js"></script>
        <script src="js/temp.min.js"></script>
        <script src="js/batterie.js"></script>
        <!-- third party js ends -->
        <!-- end demo js-->
    </body>
</html>