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
    if (isset($_GET['user']) && $_GET['user']){
        $query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user ='".intval(htmlspecialchars($_GET['user']))."'");
        $query->execute();
        $MenuObjetUser = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
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

        <!-- third party css -->
        <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <link href="css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/app.min.css" rel="stylesheet" type="text/css" id="light-style" /> 
        <link href="css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" /> 
        <link href="css/batterie.css" rel="stylesheet" type="text/css" />
        <link href="css/temp.css" rel="stylesheet" type="text/css" />
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
                                    <h4 class="page-title">Utilisateur</h4>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 order-lg-1"><!--Utilisateurs-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Les Utilisateurs</h4>
                                        <table class="table table-hover tabl">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nom </th>
                                                <th>Prenom</th>
                                                <th>Mail</th>
                                                <th>Mdp</th>
                                                <th>type</th>
                                                <th><i id='supp' class=''></i></th>
                                            </tr>
                                            </thead>
                                            <tbody id="tableaux" >
                                            <?php
                                            
                                                   $stmt = $pdo->prepare("SELECT * FROM users");
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    
                                                    foreach($result as $value1){
                                                            echo '<tr>
                                                            <td>'.  $value1['id_user']."</td>
                                                            <td>". $value1['nom']."</td>
                                                            <td>". $value1['prenom']."</td>
                                                            <td>". $value1['mail']."</td>
                                                            <td>".$value1['mdp']."</td>
                                                            <td>".$value1['type']."</td><td><button onclick='supp(".$value1['id_user'].")' class='col btn btn-light' style='width: 100px; height: 35px;'>Supp</button></td>";
                                                    };
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                            <div class="col-xl-12 col-lg-12 order-lg-1"><!--Ajouter-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Ajouter</h4>
                                        <div id="Ajout" class="container-fluid show">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                                    <input type="text" class="form-control"  placeholder="Nom" name="nom" id="nom">
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                                    <input type="text" class="form-control"  placeholder="Prenom" name="prenom" id="prenom">
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                                    <input type="mail" class="form-control"  placeholder="Mail"  name="mail" id="mail">
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                                    <input type="password" class="form-control"  placeholder="Mot de passe" name="mdp" id="mdp">
                                                </div>
                                                <div class="col-xl-2 col-lg-2 col-sm-12">
                                                    <span>  </span>
                                                    <!--<input type="text" class="form-control"  placeholder="serial1.py" style="width: 150px; height: 20px;" name="nds" id="nds">-->
                                                    <select class="form-control" id="type" name="type" >
                                                        <option oninput='setnc(Admin)'>admin</option>
                                                        <option oninput='setnc(User)'>user</option>
                                                        <option oninput='setnc(Autre)'>autre</option>
                                                    </select>
                                                </div>
                                                <button onclick= "ajouter()" type="submit" class="btn btn-success col-xl-1 col-lg-1 col-sm-12" ><i id="btnajou" class=""></i> Ajouter</button>
                                            </div> 
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <div class="col-xl-12 col-lg-12 order-lg-1"><!--modifier-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Modifier</h4>
                                            <div id="Ajout" class="container-fluid show">
                                                <div class="row">
                                                    <div class="row col-xl-2 col-lg-2 col-sm-12" style="padding-right: 12px;padding-left: 12px;margin-left: 0px;">
                                                        <!--<input type="text" class="form-control"  placeholder="serial1.py" style="width: 150px; height: 20px;" name="nds" id="nds">-->
                                                        <select class="form-control col-xl-6 col-lg-6 col-sm-6" id="id" name="id" >
                                                        <?php   foreach($result as $value1){
                                                                echo "<option>".$value1['id_user']."</option>";
                                                        }; ?>
                                                        </select>
                                                        <button onclick= "loaduser()" class="col btn btn-light col-xl-6 col-lg-6 col-sm-6"><i id="loaduser" class=""></i> load</button>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                                        <input type="text" class="form-control"  placeholder="Nom"  name="nom" id="nom1">
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                                        <input type="text" class="form-control"  placeholder="Prenom"  name="prenom" id="prenom1">
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                                        <input type="mail" class="form-control"  placeholder="Mail"  name="mail" id="mail1">
                                                    </div>
                                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                                        <input type="password" class="form-control"  placeholder="Mot de passe"  name="mdp" id="mdp1">
                                                    </div>
                                                    <div class="col-xl-1 col-lg-1 col-sm-12">
                                                        <!--<input type="text" class="form-control"  placeholder="serial1.py" style="width: 150px; height: 20px;" name="nds" id="nds">-->
                                                        <select class="form-control" id="type1" name="type">
                                                            <option>admin</option>
                                                            <option>user</option>
                                                            <option>autre</option>
                                                        </select>
                                                    </div>
                                                    <button onclick="modifier()" type="submit" class="btn btn-warning col-xl-1 col-lg-1 col-sm-12" ><i id="btnmodif" class=""></i> Modifier</button>
                                                </div> 
                                            </div>
                                        
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                            <div class="col-xl-12 col-lg-12 order-lg-1"><!--Menu-->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">MENU</h4>
                                        <div class="container-fluid show">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 order-lg-1 row">
                                                    <select class="form-control col" id="USER" style="width: 60px; height: 35px; margin-right:5px;" onchange="location = `${this.value}#USER`;">
                                                    <option>User <?php echo  $_GET['user']; ?></option>
                                                    <?php foreach($result as $value1){
                                                            echo "<option value='/Dashbord/utilisateur.php?user=".$value1['id_user']."'>".$value1['id_user']."</option>";
                                                    }; ?>
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-sm-12 order-lg-1 row">
                                                <table class="table mt-1" style="background-color:#333131;">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">UTILISATEUR</th>
                                                        <th scope="col">MODULE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                        <th scope="row" style="width: 330.4px;">
                                                        <ul class="metismenu side-nav h-100" id="idusers">
                                                            <?php

                                                        if($MenuObjetUser != null){
                                                            foreach ($MenuObjetUser[0] as $key => $value){
                                                                if ($key != "id_menu" && $key != "id_user"){
                                                                    if($value != ""){
                                                                    ?>
                                                                        <il class="side-nav-title side-nav-item"><?php echo $key; ?></il>
                                                                        <?php
                                                                        $obj = explode(",",$MenuObjetUser[0][$key]);
                                                                        foreach ($obj as $value2){
                                                                            if ($value2 != ""){
                                                                                include('menu/'.$value2); 
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                        </th>
                                                        <td  style="width: 330.4px;">
                                                        <ul class="metismenu side-nav">
                                                            <?php 
                                                                $arrayFile=[];
                                                                $valut = scandir("menu");
                                                                array_shift($valut);
                                                                array_shift($valut);
                                                                 $arrayFile = $valut;
                                                                if($valut != null){
                                                                    foreach ($valut as $value){
                                                                        //var_dump($value);
                                                                        if($value != ""){
                                                                            include('menu/'.$value); 
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                            </ul>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 order-lg-1 row">
                                                    <select class="form-control col-xl-3 col-lg-3 ml-1" id="addFile2">
                                                        <?php
                                                            if($MenuObjet != null){
                                                                foreach ($MenuObjet[0] as $key => $value){
                                                                    if ($key != "id_menu" && $key != "id_user"){
                                                                        echo '<option value="'.$key.'">'.$key.'</option>';
                                                                    }
                                                                }
                                                            }    
                                                        ?>
                                                    </select>
                                                    <a href="javascript:addFill();" class="btn btn-light ml-1 col-xl-1 col-lg-1"><img src="icons/caret-left-fill.svg"><img src="icons/caret-left-fill.svg"><img src="icons/caret-left-fill.svg"></a>
                                                    <select class="form-control col-xl-3 col-lg-3 ml-1" id="addFile3">
                                                            <?php if($arrayFile != null){
                                                                    foreach($arrayFile as $value){
                                                                        if($value != ""){
                                                                            echo '<option value="'.$value.'">'.$value.'</option>';
                                                                        }
                                                                    }
                                                                } 
                                                            ?>
                                                    </select>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 order-lg-1 mt-1 row">
                                                    <select class="form-control col-xl-3 col-lg-3 ml-1" id="delFillCOL">
                                                    <option>Selection</option>
                                                            <?php if($MenuObjet != null){
                                                                    foreach($MenuObjet[0] as $key => $value){
                                                                        if ($key != "id_menu" && $key != "id_user"){
                                                                            echo '<option value="'.$key.'">'.$key.'</option>';
                                                                        }
                                                                    }
                                                                } 
                                                                ?>
                                                    </select>
                                                    <select class="form-control col-xl-3 col-lg-3 ml-1" id="delFillHTML">
                                                        <?php
                                                        if($arrayFile != null){
                                                                    foreach($arrayFile as $value){
                                                                        if($value != ""){
                                                                            echo '<option value="'.$value.'">'.$value.'</option>';
                                                                        }
                                                                    }
                                                                } 
                                                        ?>
                                                    </select>
                                                    <a href="javascript:delFill();" class="btn btn-light ml-1 col-xl-1 col-lg-2"><img src="icons/trash-fill.svg"></a>
                                                </div>
                                                <span class="col-xl-12 col-lg-12 order-lg-1">Ajouter ou Supprime un sous menu</span>
                                                <div class="col-xl-12 col-lg-12 order-lg-1 mt-1 row">
                                                    <input type="text" class="col-xl-3 col-lg-4 form-control ml-1" placeholder="Ajouter un sous menu" id="addColone">
                                                    <a href="javascript:addColone();" class="btn btn-light ml-1 col-xl-1 col-lg-2 ">Ajouter</a>
                                                    <select class="form-control col-xl-3 col-lg-3 ml-1" id="DELColone">
                                                    <option>Selection</option>
                                                            <?php if($MenuObjet != null){
                                                                    foreach($MenuObjet[0] as $key => $value){
                                                                        if ($key != "id_menu" && $key != "id_user"){
                                                                            echo '<option value="'.$key.'">'.$key.'</option>';
                                                                        }
                                                                    }
                                                                } 
                                                                ?>
                                                    </select>
                                                    <a href="javascript:DELColone();" class="btn btn-light ml-1 col-xl-1 col-lg-2 "><img src="icons/trash-fill.svg"></a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
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