<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
require('function.php');
?>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        $notificationMessage = "Login gagal!";
    } else if ($_GET['pesan'] == "gigil") {
        $notificationMessages = "Gigil notification message!"; // Change this message as needed
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('http://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
  
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
             
              <!-- Nested Row within Card Body -->
              <center>
              <img class="lglsp1" src="logolsp.png" width="150" style="display: block; margin-left: 10px; margin-right: 10px; width: 100px; height: 100px;"></center>
              <div class="row">
              
                            <!-- First Form -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <br>
                                        <h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>
                                            Asesi</h3>
                                    </div>
                                    <br>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Username" required="" id="username" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="password"
                                                placeholder="Password" required="" id="password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <center>
                                        <button class="btn btn-success btn-user btn-block" name="login"
                                           type="submit"> Login </button> 
                                           </center>
                                        <hr>
                                    </form>
                                </div>
                            </div>

                            <!-- Second Form -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <br>
                                        <h3 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>
                                            Asesor</h3>
                                    </div>
                                    <br>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Username" required="" id="username" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="password"
                                                placeholder="Password" required="" id="password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <center>
                                        <button class="btn btn-success btn-user btn-block" name="logindua"
                                           type="submit"> Login </button> 
                                           </center> 
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>