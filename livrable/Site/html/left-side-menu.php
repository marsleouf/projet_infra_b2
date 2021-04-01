<!-- ========== Left Sidebar Start ========== -->
<?php 
$query = $pdo->prepare("SELECT * FROM `menu` WHERE id_user = '$curr_user->id_user'");
$query->execute();
$MenuObjet = $query->fetchAll(PDO::FETCH_ASSOC);
//convertArray($objet);
//var_dump($MenuObjet);
//$data = json_decode($MenuObjet, JSON_OBJECT_AS_ARRAY);
?>
<div class="left-side-menu">
<script src="js/menu.min.js"></script>
    <!-- LOGO -->
    <a href="index.php" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.php" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>
    
        <!--- Sidemenu -->
        
       
        <ul class="metismenu side-nav">

      <?php 
      try {
          //var_dump($MenuObjet);
        if($MenuObjet != null){
            foreach ($MenuObjet[0] as $key => $value){
                if ($key != "id_menu" && $key != "id_user"){
                    ?><il class="side-nav-title side-nav-item"><?php echo $key; ?></il><?php
                    if($value != "" || $value != null){
                        $obj = explode(",",$MenuObjet[0][$key]);
                        foreach ($obj as $value2){
                            if ($value2!=""){
                                include('menu/'.$value2); 
                            }
                           
                        }
                    }
                }
            }
        }
    } catch (Error $err){
        //var_dump($err);
    }
        
        //var_dump(scandir("menu"));
      ?>
        <!-- <ul class="metismenu side-nav" ></ul> -->
        
            <!-- <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <img class="uil-home-alt" src="icons/columns-gap.svg"></img>
                    <span class="badge badge-success float-right">4</span>
                    <span> Dashboards </span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="/Dashbord/index.php">Dashboards</a>
                    </li>
                    <li>
                        <a href="/Dashbord/eclairage.php">Eclairage</a>
                    </li>
                    <li>
                        <a href="/Dashbord/prise.php">Prise</a>
                    </li>
                    <li>
                        <a href="dashboard-projects.html">Projects</a>
                    </li>
                </ul>
            </li> -->

            <!--

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <img class="iconbarto" src="icons/lightning-fill.svg"></img>
                    <span> Elecletrique </span>
                    <img class="menu-arrow" src="icons/chevron-right.svg"></img>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="/Dashbord/batterie.php">Stocages et Production</a>
                    </li>
                    <li>
                        <a href="/Dashbord/eclairage.php">Eclairage</a>
                    </li>
                    <li>
                        <a href="/Dashbord/prise.php">Prise</a>
                    </li>
                    <li>
                        <a href="dashboard-projects.html">Projects</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="/Dashbord/eau.php" class="side-nav-link">
                    <img class="iconbarto" src="icons/droplet-fill.svg"></img>
                    <span> Eau </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/Dashbord/gas.php" class="side-nav-link">
                    <img class="iconbarto" src="icons/gas.svg"></img>
                    <span> Gaz </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="/Dashbord/Meteo.php" class="side-nav-link">
                    <img class="iconbarto" src="icons/sun.svg"></img>
                    <span> Meteo </span>
                </a>
            </li> -->
            <il class="side-nav-title side-nav-item">Parametre</il>
            <?php
                if ($user['type'] == "admin") { ?>
            <li class="side-nav-item">
                <!--Parametre-->
                <a href="javascript: void(0);" class="side-nav-link">
                    <img class="iconbar iconbarto" src="icons/gear-fill.svg"></img>
                    <span> Parametre </span>
                    <img class="menu-arrow" src="icons/chevron-right.svg"></img>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="/Dashbord/parametre.php"><img class="iconbarto" src="icons/gear-fill.svg"></img>Parametre</a>
                    </li>
                    <li>
                        <a href="/Dashbord/utilisateur.php"><img class="iconbarto" src="icons/add-user.svg"></img>Utilisateur</a>
                    </li>
                    <li>
                        <a href="/Dashbord/objet.php"><img class="iconbarto" src="icons/lightbulb.svg"></img>Object Connecter</a>
                    </li>
                </ul>
            </li>
            <?php }else{
                ?>
                <li class="side-nav-item">
                    <!--Parametre-->
                    <a href="/Dashbord/parametre.php" class="side-nav-link">
                        <img class="iconbar iconbarto" src="icons/gear-fill.svg"></img>
                        <span> Parametre </span>
                        
                    </a>
                </li>
            <?php } ?>
            
        </ul>

        <!-- Help Box 
      <div class="help-box text-white text-center">
          <a href="javascript: void(0);" class="float-right close-btn text-white">
              <i class="mdi mdi-close"></i>
          </a>
          <img src="images/help-icon.svg" height="90" alt="Helper Icon Image" />
          <h5 class="mt-3">Unlimited Access</h5>
          <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
          <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
      </div>
      <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->