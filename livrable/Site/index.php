<?php
include_once('models/user_model.php');
include_once('config/pdo.php');
session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = FALSE;
    header('Location: /Dashbord/connect/form_connex.html');
} else if ($_SESSION['isConnected']) {

    $curr_user = $_SESSION['user'];
    $reponse_user = $pdo->query("SELECT * FROM users WHERE mail LIKE '$curr_user->mail'");
    $user = $reponse_user->fetch();
    $image = "/" . substr($user['path_img'], 16);

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
    <!-- App favicon -->
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
    <!-- third party css end -->
    
    <!-- App css -->



</head>
<!-- <body class="loading" data-layout-config='{
    leftSideBarTheme:"dark",
    layoutBoxed:false, 
    leftSidebarCondensed:false, 
    leftSidebarScrollable:false,
    darkMode:false, 
    showRightSidebarOnStart: true
}' data-dark="" data-boxed="<?php echo $Boxed ?>" data-leftbar=<?php echo $BarTheme ?>> -->
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
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
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
                                            <a href="/Dashbord/batterie.php" class="dropdown-item">Plus info</a>
                                            <!-- item-
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                <!-- item
                                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                <!-- item
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>-->
                                        </div>
                                    </div>

                                    <h4 class="header-title">Batteries</h4>
                                    <img src="icons/battery.svg" class="diagramimg mdi1 imgec"></img>
                                    <div id="average-sales" class="apex-charts mb-4 mt-4" data-colors="<?php echo $color1 ?>,<?php echo $color2 ?>"></div>


                                    <div class="chart-widget-list">
                                        <div class="mdi1" style="background-color:<?php echo $color1 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <span style="margin-left: 27px;" id="BatText"> Energies Sto </span>
                                        <span class="float-right" id="BatValue">1800 AH</span>
                                        </p>
                                        <p class="mb-0">
                                            <div class="mdi" style="background-color:<?php echo $color2 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;" id="BatResteText"> Reste </span>
                                            <span class="float-right" id="BatResteValue">200 AH</span>
                                        </p>

                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->


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
                                            <a href="javascript:up1();" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                    <h4 class="header-title">Stokage D'EAU</h4>
                                    <img id="eau" src="icons/droplet-fill.svg" class="diagramimg eau"></img>
                                    <div id="average-sales1" class="apex-charts mb-4 mt-4" data-colors1="<?php echo $color3 ?>,<?php echo $color4 ?>"></div>
                                    <div class="chart-widget-list">

                                        <div id="colr3" class="mdi1" style="background-color:<?php echo $color3 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <span style="margin-left: 27px;"> Eau </span>

                                        <span class="float-right">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr4" class="mdi" style="background-color:<?php echo $color4 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right">1000 L</span>
                                        </p>
                                        <!-- <button onclick="des();">supp</button>
                                            <button onclick="ajo();">ajouter</button>
                                            <button onclick="up1();">ajouter</button>
                                            <button onclick="up2();">ajouter</button>
                                            <button onclick="up3();">ajouter</button>-->
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

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
                                    <img src="icons/gas.svg" class="diagramimg"></img>
                                    <div id="average-sales3" class="apex-charts mb-4 mt-4" data-colors3="<?php echo $color5 ?>,<?php echo $color6 ?>"></div>
                                    <div class="chart-widget-list">
                                        <div id="colr5" class="mdi1" style="background-color:<?php echo $color5 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <p>
                                            <span style="margin-left: 27px;"> Gaz </span>
                                            <span class="float-right" id="GazValue">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr6" class="mdi" style="background-color:<?php echo $color6 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right" id="GazResteValue">1000 L</span>
                                        </p>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-3 col-lg-6 order-lg-1">
                            <!--Cecle 4-->
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
                                    <h4 class="header-title">stokage cardurant</h4>
                                    <img src="icons/station.svg" class="diagramimg"></img>
                                    <div id="average-sales4" class="apex-charts mb-4 mt-4" data-colors4="<?php echo $color7 ?>,<?php echo $color8 ?>"></div>

                                    <div class="chart-widget-list">
                                        <div id="colr5" class="mdi1" style="background-color:<?php echo $color7 ?> !important;width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                        <p>
                                            <span style="margin-left: 27px;"> Gaz </span>
                                            <span class="float-right" id="GazValue">1000 L</span>
                                        </p>
                                        <p class="mb-0">
                                            <div id="colr6" class="mdi" style="background-color:<?php echo $color8 ?> !important; width: 20px ;height: 15px; z-index:1;position: absolute;margin-top: 4px;"></div>
                                            <span style="margin-left: 27px;">Reste </span>
                                            <span class="float-right" id="GazResteValue">1000 L</span>
                                        </p>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="progress-circle">
                        </div>


                        <!-- end col -->

                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
                            <div class="card">
                                <div class="card-body">
                                    <a href="" class="btn btn-sm btn-link float-right mb-3">Export
                                        <i class="mdi mdi-download ml-1"></i>
                                    </a>
                                    <h4 class="header-title mt-2">Top Selling Products</h4>

                                    <div class="table-responsive">
                                        <table class="table table-centered table-nowrap table-hover mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">ASOS Ridley High Waist</h5>
                                                        <span class="text-muted font-13">07 April 2018</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$79.49</h5>
                                                        <span class="text-muted font-13">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">82</h5>
                                                        <span class="text-muted font-13">Quantity</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$6,518.18</h5>
                                                        <span class="text-muted font-13">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">Marco Lightweight Shirt</h5>
                                                        <span class="text-muted font-13">25 March 2018</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$128.50</h5>
                                                        <span class="text-muted font-13">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">37</h5>
                                                        <span class="text-muted font-13">Quantity</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$4,754.50</h5>
                                                        <span class="text-muted font-13">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">Half Sleeve Shirt</h5>
                                                        <span class="text-muted font-13">17 March 2018</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$39.99</h5>
                                                        <span class="text-muted font-13">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">64</h5>
                                                        <span class="text-muted font-13">Quantity</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$2,559.36</h5>
                                                        <span class="text-muted font-13">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">Lightweight Jacket</h5>
                                                        <span class="text-muted font-13">12 March 2018</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$20.00</h5>
                                                        <span class="text-muted font-13">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">184</h5>
                                                        <span class="text-muted font-13">Quantity</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$3,680.00</h5>
                                                        <span class="text-muted font-13">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">Marco Shoes</h5>
                                                        <span class="text-muted font-13">05 March 2018</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$28.49</h5>
                                                        <span class="text-muted font-13">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">69</h5>
                                                        <span class="text-muted font-13">Quantity</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="font-14 my-1 font-weight-normal">$1,965.81</h5>
                                                        <span class="text-muted font-13">Amount</span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        <div class="col-xl-3 col-lg-5 order-lg-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
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
                                    <h4 class="header-title mb-2">Recent Activity</h4>

                                    <div data-simplebar style="max-height: 424px;">
                                        <div class="timeline-alt pb-0">
                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info font-weight-bold mb-1 d-block">You sold an item</a>
                                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">5 minutes ago</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary font-weight-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                    <small>Dave Gamache added
                                                        <span class="font-weight-bold">Admin Dashboard</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">30 minutes ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info font-weight-bold mb-1 d-block">Robert Delaney</a>
                                                    <small>Send you message
                                                        <span class="font-weight-bold">"Are you there?"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">2 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary font-weight-bold mb-1 d-block">Audrey Tobey</a>
                                                    <small>Uploaded a photo
                                                        <span class="font-weight-bold">"Error.jpg"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">14 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info font-weight-bold mb-1 d-block">You sold an item</a>
                                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">16 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary font-weight-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                    <small>Dave Gamache added
                                                        <span class="font-weight-bold">Admin Dashboard</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">22 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info font-weight-bold mb-1 d-block">Robert Delaney</a>
                                                    <small>Send you message
                                                        <span class="font-weight-bold">"Are you there?"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">2 days ago</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end timeline -->
                                    </div> <!-- end slimscroll -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card-->
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">


                        <div class="col-xl-12  col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
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
                                    <h4 class="header-title mb-3">Heur de Soleil </h4>

                                    <div id="high-performing-product" class="apex-charts" data-colors="#FF1414,#21C421"></div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->

                        </div> <!-- end col -->
                        <div class="col-xl-12  col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
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
                                    <h4 class="header-title mb-3">mm Pluie </h4>

                                    <div id="high-performing-product1" class="apex-charts" data-colors="#FF1414,#21C421"></div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
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
                                    <h4 class="header-title mb-3">Revenue</h4>

                                    <div class="chart-content-bg">
                                        <div class="row text-center">
                                            <div class="col-md-6">
                                                <p class="text-muted mb-0 mt-3">Current Week</p>
                                                <h2 class="font-weight-normal mb-3">
                                                    <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                                                    <span>$58,254</span>
                                                </h2>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-muted mb-0 mt-3">Previous Week</p>
                                                <h2 class="font-weight-normal mb-3">
                                                    <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                                    <span>$69,524</span>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dash-item-overlay d-none d-md-block">
                                        <h5>Today's Earning: $2,562.30</h5>
                                        <p class="text-muted font-13 mb-3 mt-2">Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.
                                            Etiam rhoncus...</p>
                                        <a href="javascript: void(0);" class="btn btn-outline-primary">View Statements
                                            <i class="mdi mdi-arrow-right ml-2"></i>
                                        </a>
                                    </div>

                                    <div id="revenue-chart" class="apex-charts mt-3" data-colors="#FF1414,#24EB5D"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
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
                                    <h4 class="header-title">Revenue By Location</h4>
                                    <div class="mb-4 mt-4">
                                        <div id="world-map-markers" style="height: 224px"></div>
                                    </div>

                                    <h5 class="mb-1 mt-0 font-weight-normal">New York</h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold">72k </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-0 font-weight-normal">San Francisco</h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold">39k </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-0 font-weight-normal">Sydney</h5>
                                    <div class="progress-w-percent">
                                        <span class="progress-value font-weight-bold">25k </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 mt-0 font-weight-normal">Singapore</h5>
                                    <div class="progress-w-percent mb-0">
                                        <span class="progress-value font-weight-bold">61k </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->



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

    <!-- Right Sidebar Parametre -->
    <?php include('html/right-bar.php'); ?>

    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->
    
    <?php include('html/comJs.php'); ?>
    <script src="js/batterie.min.js"></script>
    <script src="js/meteo.min.js"></script>
    <script src="js/dashboard.js"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <!-- end demo js-->
</body>

</html>