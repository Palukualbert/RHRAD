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
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="login.php" data-bs-toggle="dropdown">
                    <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                </a>
        </ul>
    </div>
</nav>
<div class="container-scroller">
    <div class="form-container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Calculer la prime de l'Employé</h4>
                <form class="forms-sample" action="PrimeEmployes.php" method="POST">
                    <div class="form-group">
                        <label for="matricule">Matricule</label>
                        <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule" required>
                    </div>
                    <div class="form-group">
                        <label for="Grade">Grade</label>
                        <select class="form-control" id="Grade" name="Grade" required>
                            <option value="DP">DP</option>
                            <option value="CD">CD</option>
                            <option value="CB">CB</option>
                            <option value="Encodeur_RH">Encodeur_RH</option>
                            <option value="Encodeur_REMUN">Encodeur_REMUN</option>
                            <option value="Encodeur_CONGES">Encodeur_CONGES</option>
                            <option value="Encodeur_POSTES">Encodeur_POSTES</option>
                            <option value="autre">Autre</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_remuneration">Date de Remuneration</label>
                        <input type="date" class="form-control" id="date" name="date_remuneration" placeholder="Date de rémunération" required>
                    </div>

                    <div class="form-group">
                        <label for="nb_jours_prestes">Nombre de Jours Prestés</label>
                        <input type="number" class="form-control" id="nb_jours_prestes" name="nb_jours_prestes" placeholder="Nombre de Jours Prestés" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Calculer Prime</button>
                    <button type="reset" class="btn btn-dark">Annuler</button>
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
