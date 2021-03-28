 <?php $quey = "SELECT * FROM notification";
    $query = $pdo->prepare($quey);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);
    }
    ?>
 <!-- Topbar Start -->
 <div class="navbar-custom">
     <ul class="list-unstyled topbar-right-menu float-right mb-0">
         <!--<li class="dropdown notification-list d-lg-none">
             <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                 <i class="dripicons-search noti-icon"></i>
             </a>
         </li>-->
         <li class="dropdown notification-list">

             <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                 <img class="dripicons-bell noti-icon" src="icons/bell-fill.svg"></img>
                 <!--<span class="noti-icon-badge notif" id="notifcolor"></span>-->
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" style="width:25rem;">
                 <!-- item-->
                 <div class="dropdown-item noti-title">
                     <h5 class="m-0">
                         <span class="float-right">
                             <a href="javascript: void(0);" class="text-dark">
                                 <small>Reload</small>
                             </a>
                             <a href="javascript: clearAll();" class="text-dark">
                                 <small>Clear All</small>
                             </a>

                         </span>Notification
                     </h5>
                 </div>
                 <div style="max-height: 230px;" data-simplebar>
                     <!-- item-->
                     <?php //echo($results);
                        ?>
                     <?php foreach ($results as $value1) {
                            $datedeff = dateDifference($value1['date'], date("Y-m-d H:i:s"), '%y Year %m Month %d Day'); ?>

                         <a href="javascript:void(0);" class="dropdown-item notify-item" id="notif">
                             <div class="notify-icon" style=" background-color:<?php echo $value1['color']; ?>">
                                 <img class="mdi mdi-comment-account-outline notificon" src="<?php echo $value1['icon']; ?>"></img>
                             </div>
                             <p class="notify-details"><?php echo $value1['titre']; ?></p>
                             <p class="notify-details"><?php echo $value1['text']; ?>
                                 <small class="text-muted"><?php echo $datedeff; ?></small>
                                 <small onclick="javascript:up2();" class="text-muted btn btn1"><img src="icons/trash.svg" class="notificon"></img></small>
                             </p>
                         </a>
                     <?php }; ?>
                 </div>
                 <!-- All
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    View All
                </a>-->
             </div>
         </li>
         <li class="dropdown notification-list d-none d-sm-inline-block">
             <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                 <img class="dripicons-view-apps noti-icon" src="icons/grid-3x3-gap-fill.svg"></img>
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg p-0">
                 <div class="p-2">
                     <div class="row no-gutters">
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/slack.png" alt="slack">
                                 <span>Slack</span>
                             </a>
                         </div>
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/github.png" alt="Github">
                                 <span>GitHub</span>
                             </a>
                         </div>
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/dribbble.png" alt="dribbble">
                                 <span>Dribbble</span>
                             </a>
                         </div>
                     </div>
                     <div class="row no-gutters">
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/bitbucket.png" alt="bitbucket">
                                 <span>Bitbucket</span>
                             </a>
                         </div>
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/dropbox.png" alt="dropbox">
                                 <span>Dropbox</span>
                             </a>
                         </div>
                         <div class="col">
                             <a class="dropdown-icon-item" href="#">
                                 <img src="images/brands/g-suite.png" alt="G Suite">
                                 <span>G Suite</span>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         </li>
         <li class="notification-list">
             <a class="nav-link right-bar-toggle" href="javascript: void(0);">
                 <img class="dripicons-gear noti-icon" src="icons/gear-fill.svg" style="margin-top: 26px;"></img>
             </a>
         </li>
         <li class="dropdown notification-list">
             <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                 <span class="account-user-avatar">
                     <img src="<?php try {if ($image != '/'){echo $image;}else{echo '/Dashbord/images/user.png';}} catch (\Exception $tr){}?>"  class="rounded-circle">
                 </span>
                 <span>
                     <span class="account-user-name"><?php echo $user['prenom'] . " " . $user['nom'] ?></span>
                     <span class="account-position"><?php echo $user['type']; ?></span>
                 </span>
             </a>
             <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                 <!-- item-->
                 <?php if ($user['type'] == "admin") { ?>
                     <div class=" dropdown-header noti-title">
                         <h6 class="text-overflow m-0">Bienvenue Admin !</h6>
                     </div>
                 <?php } else { ?>
                     <div class=" dropdown-header noti-title">
                         <h6 class="text-overflow m-0">Bienvenue !</h6>
                     </div>
                 <?php } ?>
    
                 <!-- item
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="mdi mdi-account-circle mr-1"></i>
                <span>My Account</span>
                </a>-->

                 <!-- item
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-edit mr-1"></i>
                                        <span>Settings</span>
                                    </a>-->

                 <!-- item
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lifebuoy mr-1"></i>
                                        <span>Support</span>
                                    </a>-->

                 <!-- item
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="mdi mdi-lock-outline mr-1"></i>
                                        <span>Lock Screen</span>
                                    </a>-->

                 <!-- item-->
                 <a href="/Dashbord/myaccount.php" class="dropdown-item notify-item">
                     <img class="mdi mdi-logout mr-1" src="icons/person-fill.svg"></img>
                     <span>My account</span>
                 </a>
                 <a href="/Dashbord/connect/deconnexion.php" class="dropdown-item notify-item">
                     <img class="mdi mdi-logout mr-1" src="icons/power.svg"></img>
                     <span>Déconnexion</span>
                 </a>
             </div>
         </li>
     </ul>
     <button class="button-menu-mobile open-left disable-btn">
         <img src="icons/list.svg" class="mdi mdi-menu noti-icon"></img>
     </button>
     <div class="app-search dropdown d-none d-lg-block">
         <!--<form>
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                <span class="mdi mdi-magnify search-icon"></span>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>-->
         <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
             <!-- item-->
             <div class="dropdown-header noti-title">
                 <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
             </div>
             <!-- item-->
             <a href="javascript:void(0);" class="dropdown-item notify-item">
                 <i class="uil-notes font-16 mr-1"></i>
                 <span>Analytics Report</span>
             </a>
             <!-- item-->
             <a href="javascript:void(0);" class="dropdown-item notify-item">
                 <i class="uil-life-ring font-16 mr-1"></i>
                 <span>How can I help you?</span>
             </a>
             <!-- item-->
             <a href="javascript:void(0);" class="dropdown-item notify-item">
                 <i class="uil-cog font-16 mr-1"></i>
                 <span>User profile settings</span>
             </a>
             <!-- item-->
             <div class="dropdown-header noti-title">
                 <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
             </div>
             <div class="notification-list">
                 <!-- item-->
                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                     <div class="media">
                         <img class="d-flex mr-2 rounded-circle" src="images/users/avatar-2.jpg" alt="Generic placeholder image" height="32">
                         <div class="media-body">
                             <h5 class="m-0 font-14">Erwin Brown</h5>
                             <span class="font-12 mb-0">UI Designer</span>
                         </div>
                     </div>
                 </a>
                 <!-- item-->
                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                     <div class="media">
                         <img class="d-flex mr-2 rounded-circle" src="images/users/avatar-5.jpg" alt="Generic placeholder image" height="32">
                         <div class="media-body">
                             <h5 class="m-0 font-14">Jacob Deo</h5>
                             <span class="font-12 mb-0">Developer</span>
                         </div>
                     </div>
                 </a>
             </div>
         </div>
     </div>
 </div>
 <!-- end Topbar -->