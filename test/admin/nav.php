<?php 
ob_start();
require_once "../vendor/autoload.php";
use Fbdn\Utilities\Utility;
$db = new Utility();
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
	<div class="container">
          <!-- Topbar Search -->
          <h1 class="col-md-12">Admin Panel</h1>
	</div>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
             
              <!-- Dropdown - Messages -->
             
            </li>

            <!-- Nav Item - Alerts -->
            

            <!-- Nav Item - Messages -->
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown arrow">
				<?php
				if(isset($_SESSION['admin'])){
                ?>
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['admin']['nome']." ".$_SESSION['admin']['cognome']?></span>
                <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
              </a>
				<?php
				}else{
					header('location:login.php');
				}
				?>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                
                
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>