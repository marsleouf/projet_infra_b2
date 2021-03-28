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
    try{
        $fail2ban = new PDO('sqlite:/var/lib/fail2ban/fail2ban.sqlite3',"","");
        //$fail2ban->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        //$db = new SQLite3('/var/lib/fail2ban/fail2ban.sqlite3');
        
    } catch(Exception $e) {
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    };
    include('models/parametreshow.php');
 
}
function sysCmd($cmd) {
	exec( $cmd . " 2>&1", $output);
	return $output;
}
    
?>
 <!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="utf-8" />
        <title>Dashboard Status server</title>
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
                                    <h4 class="page-title">Status server</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card col-xl-12 col-lg-12 col-sm-12 order-lg-12" >
                                <div class="card-body" style="padding-left: 0%; padding-right: 0%;">
                                    <h5 class="card-title">Fail2ban</h5> 

                                <div class="col-sm-12 card col-xl-12 col-lg-12 table-responsive " style="width: 100%;  height: 700px;" >
                                    <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>Jail</th>
                                                <th>Ip </th>
                                                <th>Time of Bann</th>
                                                <th>Data</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody id="tableaux" >
                                            <?php 
                                                $results = $fail2ban->query('SELECT * FROM bans ORDER BY timeofban DESC');
                                                $result = $results->fetchAll();
                                                foreach($result as $key=>$value) { 
                                                    $classAtack ="";
                                                    if($value[0] == "sshd"){ 
                                                       $classAtack = "table-danger";
                                                    } else if($value[0] == "nginx-4xx"){
                                                        $classAtack = "table-warning";
                                                    }
                                                    
                                                    ?>
                                                    <tr class="<?php echo $classAtack ?>">
                                                        <td><?php echo $value[0]; ?></td>
                                                        <td><?php echo $value[1]; ?></td>
                                                        <td><?php echo date('d/m/Y',$value[2]); ?></td>
                                                        <td><?php echo $value[3]; ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            
                                            
                                            /*$results2 = $fail2ban->query('SELECT data FROM bans');
                                        $result2 = $results2->fetchAll();
                                        var_dump($result);
                                        var_dump($result2);*/
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>        
                                </div>
                            </div>
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