<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RHRAD-CONGE</title>
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
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="login.php" data-bs-toggle="dropdown">
                    <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                </a>
        </ul>
    </div>
</nav>
    <div class="container-fluid page-body-wrapper" style="flex: 1;">
    <div class="main-panel" style="flex: 1; display: flex; flex-direction: column;">
        <div class="content-wrapper" style="flex: 1;">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title d-flex justify-content-between align-items-center">
                                <span>Liste des Employés en Congé</span>
                                <button class="btn btn-primary" onclick="window.location.href='AjouterConge.php'">
                                    <i class="fa fa-plus me-1"></i> Ajouter au Congé
                                </button>
                            </h4>
                            <form method="GET" class="input-group mb-3">
                                <input type="text" name="Nom" class="form-control" placeholder="Recherche par nom">
                                <input type="date" name="Date_Enregistrement" class="form-control" placeholder="Date d'enregistrement">
                                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i> Rechercher</button>
                            </form>
                            <?php
                            include_once 'traitement.php';

                            $traitement = new traitement();
                            $message = '';
                            $searchResults = [];

                            // Vérifier s'il y a une requête de recherche
                            if (isset($_GET['Nom']) || isset($_GET['Date_Enregistrement'])) {
                                // Lancer la recherche
                                $searchResults = $traitement->searchPersonneConge();

                                // Vérifiez si la recherche a retourné des résultats
                                if (empty($searchResults)) {
                                    $message = 'Employé introuvable';
                                    // Affichez tous les employés si aucun résultat de recherche n'a été trouvé
                                    $searchResults = $traitement->getpersonnesConge();
                                }
                            } else {
                                // Si aucune recherche n'est effectuée, affichez tous les employés
                                $searchResults = $traitement->getpersonnesConge();
                            }
                            ?>

                            <!-- Affichage des résultats de recherche ou du message d'erreur -->
                            <?php if ($message): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($message); ?>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-primary text-white">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Postnom</th>
                                        <th>Grade</th>
                                        <th>Division</th>
                                        <th>Date Enregistrement</th>
                                        <th>Début Congé</th>
                                        <th>Fin Congé</th>
                                        <th>Type</th>
                                        <th>Jours Restants</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr> 
                                    </thead>
                                    <tbody>
                                    <!-- Boucle d'affichage des employés en congé -->
                                    <?php foreach ($searchResults as $employe): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($employe['Nom']); ?></td>
                                            <td><?php echo htmlspecialchars($employe['Postnom']); ?></td>
                                            <td><?php echo htmlspecialchars($employe['Grade']); ?></td>
                                            <td><?php echo htmlspecialchars($employe['NomDivision']); ?></td>

                                            <!-- Conversion et affichage de Date_Enregistrement en format d-m-y -->
                                            <td>
                                                <?php
                                                $dateEnregistrement = new DateTime($employe['Date_Enregistrement']);
                                                echo htmlspecialchars($dateEnregistrement->format('d-m-y'));
                                                ?>
                                            </td>

                                            <!-- Conversion et affichage de DateDebut en format d-m-y -->
                                            <td>
                                                <?php
                                                $dateDebut = new DateTime($employe['DateDebut']);
                                                echo htmlspecialchars($dateDebut->format('d-m-y'));
                                                ?>
                                            </td>

                                            <!-- Conversion et affichage de DateFin en format d-m-y -->
                                            <td>
                                                <?php
                                                $dateFin = new DateTime($employe['DateFin']);
                                                echo htmlspecialchars($dateFin->format('d-m-y'));
                                                ?>
                                            </td>

                                            <td><?php echo htmlspecialchars($employe['TypeConge']); ?></td>

                                            <!-- Affichage du nombre de jours restants avant la fin du congé -->
                                            <td>
                                                <?php
                                                // Calcul et affichage des jours restants avant la fin du congé
                                                $joursRestants = $traitement->joursRestantsCongé($employe['DateDebut'], $employe['DateFin']);
                                                echo htmlspecialchars($joursRestants);
                                                ?>
                                            </td>
                                            <td><span class="badge bg-success"><?php echo htmlspecialchars($employe['Statut']); ?></span></td>
                                            <td>
                                                <a href="ModifierConge.php?CongeID=<?php echo $employe["CongeID"] ?>" class="link-success">
                                                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                                </a>
                                            </td>
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
