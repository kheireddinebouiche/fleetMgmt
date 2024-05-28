<?php 

session_start(); 
include("getter/connect.php");

?>
<!-- ========== Topbar Start ========== -->
                <div class="navbar-custom">
                    <div class="topbar">
                        <div class="topbar-menu d-flex align-items-center gap-1">

                            <!-- Topbar Brand Logo -->
                            <div class="logo-box">
                                <!-- Brand Logo Light -->
                                <a href="/app/backend" class="logo-light">
                                    <img src="images/new_fleet_mgmt.png" style="height:60px;" alt="logo" class="logo-lg mt-2">
                                    <img src="images/new_fleet_mgmt.png" style="height:60px;" alt="small logo" class="logo-sm">
                                </a>

                                <!-- Brand Logo Dark -->
                                <a href="/app/backend" class="logo-dark">
                                    <img src="images/new_fleet_mgmt.png" style="height:60px;" alt="dark logo" class="logo-lg mt-2">
                                    <img src="images/new_fleet_mgmt.png" style="height:60px;" alt="small logo" class="logo-sm mt-2">
                                </a>
                            </div>

                            <!-- Sidebar Menu Toggle Button -->
                            <button class="button-toggle-menu">
                                <i class="mdi mdi-menu"></i>
                            </button>


                            
                        </div>

                        <ul class="topbar-menu d-flex align-items-center">
                     

                            <!-- Notofication dropdown -->
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fe-bell font-22"></i>
                                    <div id="count_notifs" >
                                        
                                        
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0 font-16 fw-semibold"> Notification</h6>
                                            </div>
                                            <div class="col-auto">
                                                <a href="notification_make_reader_all.php" class="text-dark text-decoration-underline">
                                                    <small>Effacer tous</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="list_notification" class="px-1" style="max-height: 900px;" data-simplebar>
                                        
                                        <div class="text-center">
                                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                        </div>
                                    </div>
    
                                    <!-- All-->
                                    <a href="notification_list.php" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                        Voir tous
                                    </a>

                                </div>
                            </li>

                            <!-- Light/Darj Mode Toggle Button -->
                            <li class="d-none d-sm-inline-block">
                                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                                    <i class="ri-moon-line font-22"></i>
                                </div>
                            </li>

                            <!-- User Dropdown -->
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/profile-img.png" alt="user-image" class="rounded-circle">
                                    <span class="ms-1 d-none d-md-inline-block">
                                        <?php echo $_SESSION["name"]; ?> <i class="mdi mdi-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Bienvenue !</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="mon_compte.php" class="dropdown-item notify-item">
                                        <i class="fe-user"></i>
                                        <span>Mon compte</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                
                                    <form method="POST" action="disconnect.php">
                        
                                        <input type="submit" name="disconnect" class="dropdown-item notify-item" value="Déconnexion" />
                                        
                                    </form>

                                </div>
                            </li>

                            <!-- Right Bar offcanvas button (Theme Customization Panel) -->
                            <!--<li>-->
                            <!--    <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">-->
                            <!--        <i class="fe-settings font-22"></i>-->
                            <!--    </a>-->
                            <!--</li>-->
                        </ul>
                    </div>
                </div>
                <!-- ========== Topbar End ========== -->
                
<script>
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("count_notifs").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notification_count.php", true);
  xhttp.send();
}
setInterval(function(){
    loadXMLDoc();
}, 1000);

window.onload = loadXMLDoc;
</script>

<script>
function loadXMLDoc1() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list_notification").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notification_item.php", true);
  xhttp.send();
}
setInterval(function(){
    loadXMLDoc1();
}, 1000);

window.onload = loadXMLDoc;
</script>