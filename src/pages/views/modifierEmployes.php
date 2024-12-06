
<?php
// Connexion à la base de données
$dbname = "gestion_rh";
$conn = mysqli_connect("localhost", "root", "", $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']); // ID de l'employé à modifier

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les nouvelles valeurs depuis le formulaire
    $Matricule = $_POST['Matricule'];
    $Nom = $_POST['Nom'];
    $PostNom = $_POST['PostNom'];
    $Prenom = $_POST['Prenom'];
    $Grade = $_POST['Grade'];
    $NomDivision = $_POST['NomDivision'];
    $Genre = $_POST['Genre'];
    $DateNaissance = $_POST['DateNaissance'];
    $NumTelephone = $_POST['NumTelephone'];
    $Remuneration = $_POST['Remuneration'];
    $Ref_doc_affectation = $_POST['Ref_doc_affectation'];
    $Ref_acteEngagement = $_POST['Ref_acteEngagement'];

    // Récupérer les anciennes données de l'employé
    $sqlSelect = "SELECT Grade, NomDivision FROM `personnes` WHERE `id` = '$id'";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        $ancienGrade = $row['Grade'];
        $ancienneDivision = $row['NomDivision'];

        // Vérifier si le Grade ou la Division a changé
        if ($ancienGrade !== $Grade || $ancienneDivision !== $NomDivision) {
            // Clôturer l'ancien poste dans historiquePoste (si ouvert)
            $sqlUpdateHistorique = "UPDATE `historique_Postes`
                                    SET `Date_fin` = NOW()
                                    WHERE `IdPersonne` = '$id' AND `Date_fin` IS NULL";
            $conn->query($sqlUpdateHistorique);

            // Ajouter un nouveau poste dans historiquePoste
            $sqlInsertHistorique = "INSERT INTO `historique_Postes` (`Division`, `Date_debut`, `Grade`, `IdPersonne`) 
                                    VALUES ('$NomDivision', NOW(), '$Grade', '$id')";
            $conn->query($sqlInsertHistorique);
        }
    }

    // Mettre à jour les informations dans la table `personnes`
    $sql = "UPDATE `personnes` SET 
            `Matricule`='$Matricule',
            `Nom`='$Nom',
            `PostNom`='$PostNom',
            `Prenom`='$Prenom',
            `Grade`='$Grade',
            `NomDivision`='$NomDivision',
            `Genre`='$Genre',
            `DateNaissance`='$DateNaissance',
            `NumTelephone`='$NumTelephone',
            `Remuneration`='$Remuneration',
            `Ref_doc_affectation`='$Ref_doc_affectation',
            `Ref_acteEngagement`='$Ref_acteEngagement'
            WHERE `id` = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ajouter_Modifier_Employes_RH.php?msg=Modification reussie!");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Préremplir le formulaire avec les informations actuelles de l'employé
    $sql = "SELECT * FROM `personnes` WHERE `id` = '$id' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

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
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                    </a>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <?php
    $sql = "SELECT * FROM personnes WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

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
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <?php
        $sql = "SELECT * FROM `personnes` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="col-12 grid-margin py-5" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modification d'un employé</h4>
                    <form class="form-sample" method="POST" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Matricule</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Matricule" value="<?php echo $row['Matricule']; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Nom" value="<?php echo $row['Nom']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Postnom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="PostNom" value="<?php echo $row['PostNom']; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Prenom" value="<?php echo $row['Prenom']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grade</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="Grade" required>
                                            <option value="DP" <?php echo ($row['Grade'] == 'DP') ? 'selected' : ''; ?>>DP</option>
                                            <option value="CD" <?php echo ($row['Grade'] == 'CD') ? 'selected' : ''; ?>>CD</option>
                                            <option value="CB" <?php echo ($row['Grade'] == 'CB') ? 'selected' : ''; ?>>CB</option>
                                            <option value="ORDO" <?php echo ($row['Grade'] == 'ORDO') ? 'selected' : ''; ?>>ORDO</option>
                                            <option value="Agent simple" <?php echo ($row['Grade'] == 'Agent simple') ? 'selected' : ''; ?>>Agent simple</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Division</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="NomDivision" value="<?php echo $row['NomDivision']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Genre</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="Genre" required>
                                            <option value="Masculin" <?php echo ($row['Genre'] == 'Masculin') ? 'selected' : ''; ?>>Masculin</option>
                                            <option value="Feminin" <?php echo ($row['Genre'] == 'Feminin') ? 'selected' : ''; ?>>Feminin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date de naissance</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="DateNaissance" value="<?php echo $row['DateNaissance']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Numéro de téléphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="NumTelephone" value="<?php echo $row['NumTelephone']; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Rémuneration</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Remuneration" value="<?php echo $row['Remuneration']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Réf. doc d'affectation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Ref_doc_affectation" value="<?php echo $row['Ref_doc_affectation']; ?>" required />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2" name="action" value="submit">Modifier</button>
                                <button type="button" class="btn btn-danger" style="color: white" onclick="window.location.href='ajouter_Modifier_Employes_RH.php';">Annuler</button>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Réf. doc d'engagement</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Ref_acteEngagement" value="<?php echo $row['Ref_acteEngagement']; ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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