<?php
include 'traitement.php';
$message = '';
$traitement = new Traitement();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    // Récupération des données du formulaire
    $matricule = $_POST['matricule'];
    $password = $_POST['password'];
    $grade = $_POST['grade'];
    $message = $traitement->gererConnexion($matricule, $password, $grade);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
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

                            <!-- Affichage du message de retour -->
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-info" role="alert">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>

                            <form class="pt-3" method="post" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="matricule" placeholder="Entrez le matricule" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="grade" required>
                                        <option value="" disabled selected>Choisir grade</option>
                                        <option value="encodeur_rh">Encodeur RH</option>
                                        <option value="encodeur_conges">Encodeur Congés</option>
                                        <option value="encodeur_remuneration">Encodeur Rémunération</option>
                                        <option value="encodeur_poste">Encodeur Poste</option>
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
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
</body>
</html>
