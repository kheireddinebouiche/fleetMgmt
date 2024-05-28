<?php 
session_start(); 
require("check_session.php"); ?>
<!-- ========== Menu ========== -->
            <div class="app-menu">  

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="/app/backend" class="logo-light">
                       <img src="images/new_fleet_mgmt.png" style="width:90px; height:80px;" alt="dark logo" class="logo-lg mt-2">
                        <img src="images/new_fleet_mgmt.png" style="width:70px; height:50px;" alt="small logo" class="logo-sm mt-2">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a href="/app/backend" class="logo-dark">
                        <img src="images/new_fleet_mgmt.png" style="width:90px; height:80px;" alt="dark logo" class="logo-lg mt-2">
                        <img src="images/new_fleet_mgmt.png" style="width:70px; height:50px;" alt="small logo" class="logo-sm mt-2">
                    </a>
                </div>

                <!-- menu-left -->
                <div class="scrollbar">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva Kennedy</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>Mon compte</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Parametres</span>
                                </a>

                               
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Déconnexion</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted mb-0">Admin Head</p>
                    </div>

                    <!--- Menu -->
                    <ul class="menu">

                        <li class="menu-title">Navigation</li>
                        <div>
                        <li class="menu-item">
                            <a href="/app/backend/"  class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                                <span class="menu-text"> Tableau de bord </span>
                            </a>
                            
                        </li>
                        </div>
                        
                        <!-- Géstion des véhicules -->
                        <div <?php if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){$fep = "visible"; }else{ $fep="hidden"; } ?> <?php echo $fep; ?>>
                            <li class="menu-title">Véhicules</li>
                        
                            <li class="menu-item">
                                <a href="list-vehicules.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-book-alert-outline"></i></span>
                                    <span class="menu-text"> Liste des véhicules </span>
                                </a>
                            </li>
    
                            <li class="menu-item">
                                <a href="ajouter-vehicule.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-car"></i></span>
                                    <span class="menu-text"> Ajouter un véhicule </span>
                                </a>
                            </li>
                        </div>
                        <!-- fin Géstion des véhicules -->
                        
                        <!-- Géstion des véhicules -->

                        <li class="menu-title">Entretien & Maintenance</li>
                        <div <?php if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){$fef = "visible"; }else{ $fef="hidden"; } ?> <?php echo $fef; ?> >
                            <li class="menu-item">
                                <a href="suivie_vidange.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-oil-level"></i></span>
                                    <span class="menu-text"> Suivie des vidanges </span>
                                </a>
                            </li>
                            
                            <li class="menu-item">
                                <a href="archive_vidange.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-archive-arrow-down-outline"></i></span>
                                    <span class="menu-text"> Archive des vidanges </span>
                                </a>
                            </li>
    
                            <li class="menu-item">
                                <a href="suivie_maitenance.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-car-cog"></i></span>
                                    <span class="menu-text"> Maintenance des véhicules </span>
                                </a>
                            </li>
                        </div>
                        
                        <div <?php if($_SESSION["niveau"] == 3){$fe = "visible"; }else{ $fe="hidden"; } ?> <?php echo $fe; ?> >
                            <li class="menu-item">
                                <a href="user_vidange_du_vehicule.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-oil-level"></i></span>
                                    <span class="menu-text"> Vidange du véhicule </span>
                                </a>
                            </li>
                            
                            <li class="menu-item">
                                <a href="user_maintenance_du_vehicule.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-car-cog"></i></span>
                                    <span class="menu-text"> Maintenance du véhicule </span>
                                </a>
                            </li>
                        </div>
                        <!-- fin Géstion des véhicules -->

                        <li class="menu-title">Utilisateurs</li>
                        <div <?php if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){$fek = "visible"; }else{ $fek="hidden"; } ?> <?php echo $fek; ?> >
                            <li class="menu-item">
                                <a href="list-utilisateurs.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                                    <span class="menu-text"> Liste des utilisateurs </span>
                                </a>
                            </li>
                            
                            <li class="menu-item">
                                <a href="ajouter-utilisateur.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-account-plus"></i></span>
                                    <span class="menu-text"> Ajouter un utilisateur </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="users_logs.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-connection"></i></span>
                                    <span class="menu-text"> Logs de connexion </span>
                                </a>
                            </li>
                        </div>
                        <div>
                        <li  class="menu-item">
                            <a href="mon_compte.php" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-file-account-outline"></i></span>
                                <span class="menu-text"> Mon compte </span>
                            </a>
                        </li>
                        </div>
                        

                            <li class="menu-title">Affectations & Emprunts</li>
                            <div <?php if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){$fek = "visible"; }else{ $fek="hidden"; } ?> <?php echo $fek; ?>>
                            <li class="menu-item">
                                <a href="list_affectations.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-clipboard-flow"></i></span>
                                    <span class="menu-text"> Liste des affectations </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="archive_affectation.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-car-arrow-right"></i></span>
                                    <span class="menu-text"> Archives </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ajouter_affectation.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-car-arrow-right"></i></span>
                                    <span class="menu-text"> Créer une affectation </span>
                                </a>
                            </li>
                        </div>
                        <?php
                         if($_SESSION["niveau"] == 3 or $_SESSION["niveau"] == 1 ){
                             
                             $hidden = false;
                        ?>
                        <div>
                        <li <?php if($hidden) {echo "hidden";} ?>class="menu-item">
                            <a href="mon_affectation.php" class="menu-link">
                                <span class="menu-icon"><i class="mdi mdi-folder-alert-outline"></i></span>
                                <span class="menu-text"> Mon emprunt </span>
                            </a>
                        </li>
                        </div>
                        <?php
                         }
                        ?>
                        
                        <div <?php if($_SESSION["niveau"] == 1 or $_SESSION["niveau"] == 2){$fem = "visible"; }else{ $fem="hidden"; } ?> <?php echo $fem; ?>>
                            <li class="menu-title">Géstion des sinistres</li>
                            
                            <li class="menu-item">
                                <a href="list_sinistres.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-file-multiple"></i></span>
                                    <span class="menu-text"> Liste des déclaration</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ajouter_sinistre.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-file-plus"></i></span>
                                    <span class="menu-text"> Créer une déclaration </span>
                                </a>
                            </li>
                            
                            <li class="menu-item mb-5">
                                <a href="archive_sinistre.php" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-archive-arrow-down-outline"></i></span>
                                    <span class="menu-text"> Archive </span>
                                </a>
                            </li>
                        </div>

                    </ul>
                    
                    
                    
                </div>
            </div>
            <!-- ========== Left menu End ========== -->