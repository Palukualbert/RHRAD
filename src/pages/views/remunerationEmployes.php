<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" referrerpolicy="no-referrer" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .container-scroller {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
        }

        .form-check {
            margin-top: 15px;
        }
    </style>
</head>
<body>
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
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#">
                    <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<div class="container-scroller">
    <div class="form-container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Calculer la prime de l'Employé</h4>
                <form class="forms-sample" action="encodeur_REMUN.php" method="POST">
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-control" id="grade" name="grade" required>
                            <option value="DP">DP</option>
                            <option value="CD">CD</option>
                            <option value="CB">CB</option>
                            <option value="Autre">Autre Grade</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nb_jours_preste">Nombre de Jours Prestés</label>
                        <input type="number" class="form-control" id="nb_jours_preste" name="nb_jours_preste" placeholder="Nombre de Jours Prestés" required>
                    </div>
                    <div class="form-group">
                        <label for="salaire_mensuel">Salaire Mensuel</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="salaire_mensuel" name="salaire_mensuel" placeholder="Salaire Mensuel" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Calculer Prime</button>
                    <button type="reset" class="btn btn-light">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

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
</body>
</html>
