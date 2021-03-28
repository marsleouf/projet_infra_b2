<?php
include_once('models/user_model.php');
include_once('config/pdo.php');
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
}
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
  //moveFile("menu/App/elec.html","menu/Navigation/elec.html");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Parametre Dashboard</title>
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
                                <h4 class="page-title">Parametre</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-3 col-lg-6 order-lg-1">
                            <!--Cecle 1-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <img src="icons/chevron-down.svg" class="mdi mdi-dots-vertical"></img>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title">Production Electrique</h4>
                                    <img src="icons/lightning-fill.svg" class="diagramimg mdi1 imgec"></img>
                                    <div id="average-sales1" class="apex-charts mb-4 mt-4" data-colors="<?php echo $color1 ?>,<?php echo $color2 ?>">
                                    </div>

                                    <div class="chart-widget-list">
                                        <div id="colr1" class="mdi1" style="background-color:<?php echo $color1 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;">
                                        </div>
                                        <p>
                                            <span style="margin-left: 27px;"> Produite </span>
                                            <span class="float-right">8400000 kw</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr2" class="mdi" style="background-color:<?php echo $color2 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;"> Prevision du jour </span>
                                            <span class="float-right">350000 kw</span>
                                        </p>
                                    </div>
                                    <div class="chart-widget-list">
                                        <div class="row">
                                            <span class="col-5">Couleur 1</span>
                                            <input type="color" id="colorelec" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <span class="col-5">Couleur 2</span>
                                            <input type="color" id="colorelec1" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <button onclick="saveElec();" type="submit" class=" col-12 btn btn-success" style="width: 120px; height: 35px; margin-top:5px;"><i id="elec" class=""></i> Modifier</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        <div class="col-xl-3 col-lg-6 order-lg-1">
                            <!--Cecle 2-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <img src="icons/chevron-down.svg" class="mdi mdi-dots-vertical"></img>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title">Stokage D'EAU</h4>
                                    <div id="average-sales2" class="apex-charts mb-4 mt-4" data-colors1="<?php echo $color3 ?>,<?php echo $color4 ?>"><img src="icons/droplet-fill.svg" class="diagramimg eau"></img></div>

                                    <div class="chart-widget-list">
                                        <div id="colr3" class="mdi1" style="background-color:<?php echo $color3 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <p>
                                            <span style="margin-left: 27px;"> Eau </span>
                                            <span class="float-right" id="eauText">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr4" class="mdi" style="background-color:<?php echo $color4 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right" id="eauResteText">1000 L</span>
                                        </p>
                                    </div>
                                    <div class="chart-widget-list">
                                        <div class="row">
                                            <span class="col-5">Couleur 1</span>
                                            <input type="color" id="coloreau" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <span class="col-5">Couleur 2</span>
                                            <input type="color" id="coloreau1" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <button onclick="saveEau();" type="submit" class=" col-12 btn btn-success" style="width: 120px; height: 35px; margin-top:5px;"><i id="eau" class=""></i> Modifier</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        <div class="col-xl-3 col-lg-6 order-lg-1">
                            <!--Cecle 3-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <img src="icons/chevron-down.svg" class="mdi mdi-dots-vertical"></img>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title">stokage gas</h4>
                                    <div id="average-sales3" class="apex-charts mb-4 mt-4" data-colors3="<?php echo $color5 ?>,<?php echo $color6 ?>"><img src="icons/gas.svg" class="diagramimg"></img></div>


                                    <div class="chart-widget-list">
                                        <div id="colr5" class="mdi1" style="background-color:<?php echo $color5 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <p>
                                            <span style="margin-left: 27px;"> Eau </span>
                                            <span class="float-right" id="GazText">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr6" class="mdi" style="background-color:<?php echo $color6 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right" id="GazResteText">1000 L</span>
                                        </p>
                                    </div>
                                    <div class="chart-widget-list">
                                        <div class="row">
                                            <span class="col-5">Couleur 1</span>
                                            <input type="color" id="colorGaz" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <span class="col-5">Couleur 2</span>
                                            <input type="color" id="colorGaz1" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <button onclick="saveGaz();" type="submit" class=" col-12 btn btn-success" style="width: 120px; height: 35px; margin-top:5px;"><i id="gaz" class=""></i> Modifier</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->

                        </div>
                        <div class="col-xl-3 col-lg-6 order-lg-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <img src="icons/chevron-down.svg" class="mdi mdi-dots-vertical"></img>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title">stokage Carbur</h4>
                                    <div id="average-sales4" class="apex-charts mb-4 mt-4" data-colors4="<?php echo $color7 ?>,<?php echo $color8 ?>"><img src="icons/gas.svg" class="diagramimg"></img></div>


                                    <div class="chart-widget-list">
                                        <div id="colr7" class="mdi1" style="background-color:<?php echo $color7 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <p>
                                            <span style="margin-left: 27px;"> Eau </span>
                                            <span class="float-right" id="CrabuText1">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr8" class="mdi" style="background-color:<?php echo $color8 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right" id="CrabuResteText1">1000 L</span>
                                        </p>
                                    </div>
                                    <div class="chart-widget-list">
                                        <div class="row">
                                            <span class="col-5">Couleur 1</span>
                                            <input type="color" id="colorCrabu" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <span class="col-5">Couleur 2</span>
                                            <input type="color" id="colorCrabu1" class="form-control col-3 color" style="width: 75px; height: 15px;margin:2.5px;">
                                            <button onclick="saveCrabu();" type="submit" class=" col-12 btn btn-pers" style="width: 120px; height: 35px; margin-top:5px;"><i id="Crabu" class=""></i> Modifier</button>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->

                        </div>
                        <div class="col-xl-12 col-lg-12 order-lg-1">
                            <!--Ajouter-->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Météo</h4>
                                    <div id="Ajout" class="container-fluid show">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-5 order-lg-1 ">
                                                <input class="form-control dropdown-toggle nominput" role="text" id="dropdownMenuLink45" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Nom">
                                                </input>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink45" id="nom45">
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                    <a class="dropdown-item" href=""></a>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-2 order-lg-1 disabled">
                                                <input class="form-control dropdown-toggle nominput" role="text" id="codepos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="N° Postal">
                                                </input>
                                            </div>
                                            <div class="col-xl-1 col-lg-2 order-lg-1 disabled">
                                                <input class="form-control dropdown-toggle nominput" role="text" id="codedep" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="N° Departement">
                                                </input>
                                            </div>
                                            <button onclick="ajouterMeteo()" type="submit" class="btn btn-success"><i id="btnajou" class=""></i> Modifier</button>
                                        </div>
                                    </div>
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