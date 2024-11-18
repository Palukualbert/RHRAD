<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RHRAD-PRIME</title>
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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Assurez-vous que le footer est fixé en bas de la page */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .footer {
            margin-top: auto; /* Cela pousse le footer vers le bas */
            background-color: #f8f9fa; /* Couleur de fond pour le footer */
            padding: 10px; /* Espacement interne */
        }

        /* Assurez-vous que le footer est responsive */
        @media (max-width: 576px) {
            .footer .d-sm-flex {
                flex-direction: column;
                align-items: center;
            }
            .footer .text-sm-left {
                text-align: center;
            }
        }

        .table-responsive {
            max-height: 500px; /* Hauteur maximale pour le défilement */
            overflow-y: auto;
            padding: 0;
            margin: 0;
            border-bottom: 1px solid #ddd; /* Ligne de séparation en bas */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            color: white;
        }

        th, td {
            padding: 8px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="container-scroller" style="display: flex; flex-direction: column; height: 100vh;overflow: scroll;">
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
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="login.php" data-bs-toggle="dropdown">
                        <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                    </a>
            </ul>
        </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper" style="flex: 1;">
        <!-- partial -->
        <?php include_once('traitement.php'); ?>
        <div class="main-panel" style="flex: 1; display: flex; flex-direction: column;">
            <div class="content-wrapper" style="flex: 1; display: flex; flex-direction: column;">
                <div class="row" style="flex: 1; display: flex; flex-direction: column;">
                    <div class="col-lg-12 grid-margin stretch-card" style="flex: 1;">
                        <div class="card" style="flex: 1; display: flex; flex-direction: column;">
                            <div class="card-body" style="flex: 1; display: flex; flex-direction: column;">
                                <h4 class="card-title">PRIME DES EMPLOYES</h4>
                                <br>
                                <form method="GET" action="" class="input-group mb-3 d-flex justify-content-end" style="left: 10px;">
                                    <button class="btn btn-outline-primary" type="submit">Actualiser le tableau</button>
                                </form>

                                <?php
                                $traitement = new traitement();
                                $searchResults = $traitement->read();

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $matricule = $_POST['matricule'];
                                    $grade = $_POST['Grade'];
                                    $nombre_jours_prestes = $_POST['nb_jours_prestes'];
                                    $date_remuneration = $_POST['date_remuneration'];
                                    $resultat = $traitement->calculerPrime($grade, $nombre_jours_prestes);
                                    $prime = $resultat;
                                    $id_personne = $traitement->getByMatricule($matricule);
                                    $insertion = $traitement->insert_prime($prime,$date_remuneration,$nombre_jours_prestes,$id_personne);
                                }
                                ?>

                                <?php
                                if (isset($_GET["msg"])) {
                                    $msg = $_GET["msg"];
                                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                             ' . $msg . '
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                }
                                ?>
                                <!-- Formulaire de recherche -->
                                <form method="GET" action="">
                                    <div class="input-group mb-3" style="width: 100%;margin-top: 30px">
                                        <input type="text" name="query" class="form-control" placeholder="Recherche rapide (nom, matricule)"  aria-label="Recherche" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" type="submit" id="button-addon2" style="left: 5px">Rechercher</button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                // Instancier votre traitement de données
                                $traitement = new Traitement();
                                $message = '';
                                $primeEmployes = [];

                                // Vérification de la recherche
                                if (isset($_GET['query']) && !empty($_GET['query'])) {
                                    $query = $_GET['query'];
                                    $primeEmployes = $traitement->search_prime($query,$query); // Fonction pour rechercher les employés avec prime
                                    if (empty($primeEmployes)) {
                                        $message = 'Aucun employé trouvé avec ce critère.';
                                        $primeEmployes = $traitement->getPersonnesAvecPrimes(); // Si pas de résultats, on affiche tout
                                    }
                                } else {
                                    // Si aucune recherche, on affiche tous les employés avec primes
                                    $primeEmployes = $traitement->getPersonnesAvecPrimes();
                                }
                                ?>

                                <!-- Message d'erreur ou d'info -->
                                <?php if ($message): ?>
                                    <div class="alert alert-warning" role="alert">
                                        <?php echo $message; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-striped table-hover" style="font-size: 1.1em;">
                                        <thead>
                                        <tr style="background-color: #4A90E2; color: white; position: sticky; top: 0; z-index: 1; font-size: 1.2em;">
                                            <th style="padding: 12px;color: white">Matricule</th>
                                            <th style="padding: 12px;color: white">Postnom</th>
                                            <th style="padding: 12px;color: white">Nom</th>
                                            <th style="padding: 12px;color: white">Grade</th>
                                            <th style="padding: 12px;color: white">Division</th>
                                            <th style="padding: 12px;color: white">Rémunération</th>
                                            <th style="padding: 12px;color: white">Prime</th>
                                            <th style="padding: 12px;color: white">Date de rémunération</th>
                                            <th style="padding: 12px;color: white">Jours prestés</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($primeEmployes as $employe): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($employe['Matricule']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Postnom']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Nom']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Grade']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['NomDivision']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Remuneration']); ?></td>
                                                <td style="color: #0a58ca"><?php echo htmlspecialchars($employe['prime']); ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($employe['date_remuneration'])) {
                                                        $date = DateTime::createFromFormat('Y-m-d', $employe['date_remuneration']);
                                                        echo $date ? $date->format('d-m-Y') : 'Date invalide';
                                                    } else {
                                                        echo 'Date non fournie';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($employe['nombre_jours_prestes']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <!-- partial -->
</div>
<!-- main-panel ends -->

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

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
