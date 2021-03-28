<?php
    include_once('models/user_model.php');
    include_once('config/pdo.php');
    include('models/conSSH.php');

    session_start();
    if (!isset($_SESSION['isConnected'])){
        $_SESSION['isConnected'] = FALSE;
        header('Location: /Dashbord/connect/form_connex.html');
    }else if($_SESSION['isConnected']){
   // $SSH = new conneSSH();
    $curr_user = $_SESSION['user'];
    $reponse_user = $pdo->query("SELECT * FROM users WHERE mail LIKE '$curr_user->mail'");
    $user = $reponse_user->fetch();
    $image = "/".substr($user['path_img'],16);
   
    include('models/parametreshow.php');
    //ObjectAjout($pdo,"192.168.1.106","5000","Test","prise");
    //$objres = ObjectCO($pdo,4,0,1);
    //var_dump($objres[0]);
    //$jsonobj = json_decode($objres[0]["fonctions"],true);
    $objectResult = get_donner($pdo,"prise");
   // die();
}
  
?>
 <!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title>Dashboard Prises</title>
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
                                    <h4 class="page-title">Prise</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                           <?php
                           foreach($objectResult as $valeur) { ?>
                            <div class="card col-xl-12 col-lg-12 col-sm-12 order-lg-12"  >
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $valeur["name"] ?></h5> 
                                <div class="col-xl-12 col-lg-12 col-sm-12" id="<?php echo $valeur["id"] ?>error">

                                </div>
                                    <div class="row col-xl-12 col-lg-12 col-sm-12">
                                        <?php 
                                            $jsonobj = json_decode($valeur["fonctions"],true);
                                            //var_dump( $jsonobj);
                                            foreach($jsonobj['action'] as $value) { ?>
                                                <div class="card col-xl-3 col-lg-3 col-sm-5" >
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $value["name"] ?><span class="badge badge-secondary"style="margin-left:20%;" id="<?php echo $valeur["id"].$value["name"] ?>">status</span></h5>
                                                        <button onclick="javascript:btnprise(<?php echo $valeur['id'] ?>,<?php echo $value['id'] ?>,1);" class="btn btn-success col-xl-5 col-lg-5 col-sm-6" data-id="<?php echo $value["id"] ?>">ON</button>
                                                        <button onclick="javascript:btnprise(<?php echo $valeur['id'] ?>,<?php echo $value['id'] ?>,0);" class="btn btn-danger col-xl-5 col-lg-5 col-sm-6" data-id="<?php echo $value["id"] ?>">OFF</button>
                                                    </div>
                                                </div>
                                        <?php
                                            } ?>
                                    </div>
                                </div>
                            </div>
                            <?php       
                            }
                            ?>
                                    
                                                           
                                
                        </div>     
                        <!-- end row -->

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

        <?php include('html/right-bar.php'); ?>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
<script src="js/prise.js"></script>
<?php include('html/comJs.php'); ?>
<!-- third party js ends -->

<!-- demo app -->

        <!-- end demo js-->
    </body>
</html>