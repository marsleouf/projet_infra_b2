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
    if ($user['type'] != "admin"){
        header('Location: /Dashbord/index.php');
    }
include('models/parametreshow.php');
}
    
?>
 <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>My account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- third party css -->
        <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/app.min.css" rel="stylesheet" type="text/css" id="light-style" /> 
        <link href="css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" /> 
        <link href="css/batterie.css" rel="stylesheet" type="text/css" />
        <link href="css/temp.css" rel="stylesheet" type="text/css" />
        <link href="css/form_update_user.css" rel="stylesheet" type="text/css" />
    </head>
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
                                    <h4 class="page-title">My account</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 order-lg-1"><!--Utilisateurs-->
                                <div class="card">
                                    <div class="card-body row">
                                        <!-- <h4 class="header-title">Les Utilisateurs</h4> -->
                                        <div class="col-xl-9 col-lg-9 order-lg-1">
                                        <form>
                                            <div class="form-group">
                                                <label>Prenom</label>
                                                <input type="text" class="form-control" value="<?php echo $user['prenom'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nom</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $user['nom'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control" value="<?php echo $user['mail'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NEW Password</label>
                                                <input type="password" class="form-control">
                                                <small class="form-text text-muted">Pour changer le mot de passe, il faut l'accien</small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 order-lg-1 row">
                                        <img src="<?php echo $image ?>" alt="image you user" class="rounded-circle col-xl-9 col-lg-9" style="height: 250px;">
                                            <span class="h2 col-xl-12 col-lg-12"><?php echo $user['prenom']." ".$user['nom'] ?></span>
                                            <!-- <span class="h5"><?php echo $user['type']; ?></span> -->
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
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
        <script src="js/utilisateur.js"></script>
        <!-- end demo js-->
    </body>
</html>