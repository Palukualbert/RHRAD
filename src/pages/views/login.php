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
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../assets/images/logo_RHRAD.png" alt="logo">
                            </div>
                            <h6 class="font-weight-light">Connectez-vous pour profiter des services</h6>
                            <?php if (isset($_GET['error'])): ?>
                                <?php if ($_GET['error'] == 1): ?>
                                    <div class="alert alert-danger">Identifiants incorrects.</div>
                                <?php elseif ($_GET['error'] == 2): ?>
                                    <div class="alert alert-warning">Votre compte est en attente de validation par un administrateur.</div>
                                <?php elseif ($_GET['error'] == 3): ?>
                                    <div class="alert alert-danger">Votre compte a été refusé. Contactez l'administrateur.</div>
                                <?php elseif ($_GET['error'] == 4): ?>
                                    <div class="alert alert-danger">Une erreur s'est produite. Réessayez plus tard.</div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <form class="pt-3" method="post" action="process_login.php">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="matricule" placeholder="Entrez le matricule" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="grade" style="color: black " required>
                                        <option value="" disabled selected>Choisir grade</option>
                                        <option value="ENCODEUR_RH">Encodeur_RH</option>
                                        <option value="ENCODEUR_CONGES">Encodeur_Congés</option>
                                        <option value="ENCODEUR_REMUNERATION">Encodeur_Rémunération</option>
                                        <option value="ENCODEUR_POSTE">Encodeur_Poste</option>
                                        <option value="DP">DP</option>
                                        <option value="ASG">ASG</option>
                                    </select>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" name="connexion">Se connecter</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Vous n'avez pas de compte? <a href="register.php" class="text-primary">Créer</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.jsZ"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
</body>
</html>
