<?php

?>

<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>REPERTOIRE DU PERSONNEL</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo me-5 d-flex align-items-center" href="#">
                <div class="d-flex align-items-center">
                    <img src="../../assets/images/logo_RHRAD.png" style="position: fixed" alt="logo" width="110" height="60" />
                </div>
            </a>


        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
                        </div>
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Recherche rapide" aria-label="search" aria-describedby="search">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                    </a>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="icon-layout menu-icon"></i>
                        <span class="menu-title">Gestion</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="consultationProfils.php">Profils des employés</a></li>
                            <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="historiquePostes.php">Historique des Postes</a></li>
                            <li class="nav-item" style="right: 45px;"> <a class="nav-link" href="remunerationEmployes.php">Rémunération des employés</a></li>
                            <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="conges.php">Congés Autorisés</a></li>
                            <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="retraite.php">Congés Refusés</a></li>
                            <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="">Retraites des employés</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Bienvenu John,</h3>
                                <span>Faites un choix rapide de ce que vous souhaitez faire à l'aide des boutons ci-dessous.<span class="mdi mdi-debug-step-into"></span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row" style="position: relative; bottom: 20px;">
                        <div class="col-12 grid-margin transparent">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4 stretch-card transparent">
                                    <a href="remunerationEmployes.php">
                                        <button type="button" class="btn btn-primary btn-block" style="height: 220px;width: 400px; font-size: 22px; text-align: center; font-family: 'Times New Roman'; border: double;">
                                            REMUNERATION DES EMPLOYES
                                        </button>
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 mb-4 stretch-card transparent">
                                    <a href="retraiteEmployes.php">
                                        <button type="button" class="btn btn-secondary btn-block" style="height: 220px;width: 400px; font-size: 22px; text-align: center; font-family: 'Times New Roman'; border: double;">
                                            RETRAITE ET CONGE
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4 stretch-card transparent">
                                    <a href="historiquePostes.php">
                                        <button type="button" class="btn btn-success btn-block" style="height: 220px;width: 400px; font-size: 22px; text-align: center; font-family: 'Times New Roman'; border: double;">
                                            MISE EN PLACE
                                        </button>
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 stretch-card transparent">
                                    <a href="ajouter_Modifier_Employes_RH.php">
                                        <button type="button" class="btn btn-dark btn-block" style="height: 220px;width: 400px; font-size: 22px; text-align: center; font-family: 'Times New Roman'; border: double;">
                                            CONSULTATION PROFILS
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <?php
            include ('../../partials/footer.php');
            ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/template.js"></script>
<script src="../../assets/js/settings.js"></script>
<script src="../../assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>
</html>

