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

    $quey = "SELECT * FROM parametre WHERE id_user = '$curr_user->id_user'";
    $query = $pdo->prepare($quey);
    $query->execute();
    $parametre = $query->fetchAll(PDO::FETCH_ASSOC);

  
/*  
    
    $BarTheme = '"dark"'; //dark or light or default of menu
    $Boxed = "false"; // menu decaler
    $barCondensed ="true"; //minimaze
    $barScrollable ="false"; 
    $darkMode ="false"; //drak mode totale
*/
    //var_dump($parametre);
 $color1= "#31f500";
 $color2 = "#ffbc00"; 
 $color3= "#31f500";
 $color4 = "#ffbc00";
 $color5 = "#31f500";
 $color6 = "#ffbc00";  
    foreach($parametre as $value){
        $BarTheme = '"'.$value['bar_theme'].'"'; //dark or light or default of menu
        if ($value['menu_decaler'] == "0"){
            $Boxed = "false"; // menu decaler
        }
        if ($value['menu_decaler'] == "1"){
            $Boxed = "true"; // menu decaler
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
        if($value['darkmode'] == 0){
            $darkMode ="false"; //drak mode totale
        }
        if($value['darkmode'] == 1){
            $darkMode ="true"; //drak mode totale
        }
        $color1 = $value['color1'];
        $color2 = $value['color2']; 
        $color3 = $value['color3'];
        $color4 = $value['color4']; 
        $color5 = $value['color5'];
        $color6 = $value['color6']; 
        
        
    }
}
    
?>
 <!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title>Dashboard Spotify Web Playback</title>
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
                                    <h4 class="page-title">Spotify Web Playback</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <div class="card col-xl-12 col-lg-12 col-sm-12 order-lg-12" style="padding:0px">
                                    <div class="card-body" style="padding: 0px;">
                                        <h5 class="card-title"></h5>
                                        <script src="https://sdk.scdn.co/spotify-player.js"></script>
                                        <script src="js/spotify.min.js"></script>
                                        <script src="js/spotify.js" id="spotify" data-Spotify="<?php echo $user['prenom'] . " " . $user['nom'] ?>"></script>
                                        <div class="col-xl-12 col-lg-12 col-sm-12 row" style="padding:0px;margin: 0px;">
                                            <div class="col-xl-3 col-lg-3 col-sm-12" style="padding:0px">
                                                <img id="img_album" class="col-xl-12 col-lg-12 col-sm-12"></img>
                                                <h3 class="h4 col-xl-12 col-lg-12 col-sm-12 col-sm-12" id="name_play"></h3>
                                                <h3 class="h5 col-xl-12 col-lg-12 col-sm-12 col-sm-12" id="artis_play"></h3>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-sm-12 " style="padding:0px;">
                                                <div class="form-group col-xl-12 col-lg-12 col-sm-12">
                                                    <label id="Volume_label">Volume:</label>
                                                    <input type="range" class="form-control-range" min="0" max="100" step="1" id="Volume" >
                                                </div>
                                                <div class="form-group col-xl-12 col-lg-12 col-sm-12">
                                                    <label id="Time_label">Time:</label>
                                                    <input type="range" class="form-control-range"  max="" step="1000" id="Time" >
                                                </div>
                                                <div class="col-xl-12 col-lg-12" style="background-color: #000000">
                                                    
                                                    <a href="javascript:bntprevious();" class="btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffff" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                        <path fill-rule="evenodd" d="M16.354 1.646a.5.5 0 0 1 0 .708L10.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:bntplay();" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffff" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                                                    </svg></a>
                                                    <a href="javascript:bntpause();" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffff" class="bi bi-pause-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5zm3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5z"/>
                                                    </svg></a>
                                                    <a href="javascript:bntnext();" class="btn"><svg xmlns="http://www.w3.org/2000/svg"width="42" height="32" fill="#ffff" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    <path fill-rule="evenodd" d="M11.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L17.293 8 11.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg></a>
                                                </div>
                                                  <div class="col-xl-12 col-lg-12">
                                                    <a href="javascript:device();" class="btn">getDevice</a>
                                                        <div class="col-lg-12" id="device"></div>
                                                    <a href="javascript:showPlayer();" class="btn">playerDevice</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div> 
                            <div class="progress-circle">

                            </div>
                            <!-- end col -->

                          
                            <div class = "row">
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
<?php include('html/comJs.php'); ?>
<!-- third party js ends -->

<!-- demo app -->

        <!-- end demo js-->
    </body>
</html>