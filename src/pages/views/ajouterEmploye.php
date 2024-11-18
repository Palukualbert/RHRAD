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
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
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
        <div class="col-12 grid-margin py-5" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Enregistrement d'un employé</h4>
                            <form class="form-sample" method="POST" action="enregistrerEmployes.php">
                                <p class="card-description"></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Matricule</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="matricule" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Nom</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nom" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Postnom</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="postnom" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Prénom</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="prenom" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Grade</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="grade" required>
                                                    <option value="DP">DP</option>
                                                    <option value="CD">CD</option>
                                                    <option value="CB">CB</option>
                                                    <option value="ORDO">ORDO</option>
                                                    <option value="Agent simple">Agent simple</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Division</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="division" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Genre</label>
                                            <div class="col-sm-9">
                                                <select class="form-select" name="genre" required>
                                                    <option value="Masculin">Masculin</option>
                                                    <option value="Feminin">Feminin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date de naissance</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date_naissance" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Numéro de téléphone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="num_telephone" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Rémuneration</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="remuneration" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Réf. doc d'affectation</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="ref_affectation" required />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" name="action" value="enregistrer">Enregistrer</button>
                                        <button type="button" class="btn btn-danger" style="color: white" onclick="window.location.href='ajouter_Modifier_Employes_RH.php';">Annuler</button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Réf. doc d'engagement</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="ref_engagement" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="../../assets/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <!-- End custom js for this page-->
</body>
</html>