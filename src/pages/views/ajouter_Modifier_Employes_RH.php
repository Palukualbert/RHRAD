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
            height: 500px; /* Définir une hauteur fixe */
            overflow-y: scroll; /* Ajouter un défilement vertical */
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
                    <img src="../../assets/images/logo_RHRAD.png" alt="logo" width="110" height="60" />
                </div>
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="login.php"">
                        <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                    </a></li>
            </ul>
        </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper" style="flex: 1;">
        <!-- partial -->
        <?php include_once('traitement.php'); ?>
        <div class="main-panel d-flex flex-column" style="flex: 1;">
            <div class="content-wrapper d-flex flex-column" style="flex: 1;">
                <div class="row d-flex flex-column" style="flex: 1;">
                    <div class="col-lg-12 grid-margin stretch-card" style="flex: 1;">
                        <div class="card d-flex flex-column" style="flex: 1;">
                            <div class="card-body d-flex flex-column" style="flex: 1;">
                                <h4 class="card-title">GESTION DES EMPLOYES</h4>
                                <form class="d-inline" action="ajouterEmploye.php" method="POST">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Ajouter employé">
                                </form>
                                <br><br>
                                <form method="GET" action="" class="input-group mb-3 d-flex justify-content-end" style="left: 10px;">
                                    <button class="btn btn-outline-success" type="submit">Actualiser le tableau</button>
                                </form>

                                <?php if (isset($_GET["msg"])): ?>
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <?php echo htmlspecialchars($_GET["msg"]); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <!-- Formulaire de recherche -->
                                <form method="GET" action="">
                                    <div class="input-group mb-3">
                                        <input type="text" name="query" class="form-control" style="border-radius: 50px;" placeholder="Recherche rapide avec le nom ou le matricule" aria-label="Recherche" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-info" style="position: relative; left: 10px; top: 5px;" type="submit" id="button-addon2">Rechercher</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                $traitement = new traitement();
                                $message = '';
                                $searchResults = [];

                                // Vérifier s'il y a une requête de recherche
                                if (isset($_GET['query']) && !empty($_GET['query'])) {
                                    $query = $_GET['query'];
                                    $searchResults = $traitement->search($query, $query);

                                    // Vérifiez si la recherche a retourné des résultats
                                    if (empty($searchResults)) {
                                        $message = 'Employé introuvable';
                                        // Affichez tous les employés si aucun résultat de recherche n'a été trouvé
                                        $searchResults = $traitement->read();
                                    }
                                } else {
                                    // Si aucune recherche n'est effectuée, affichez tous les employés
                                    $searchResults = $traitement->read();
                                }
                                ?>
                                <?php if ($message): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($message); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="table-responsive" style="flex: 1; overflow: auto;">
                                    <table class="table table-striped" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Postnom</th>
                                            <th>Prenom</th>
                                            <th>DateNaissance</th>
                                            <th>NumTelephone</th>
                                            <th>NomDivision</th>
                                            <th>Remuneration</th>
                                            <th>Genre</th>
                                            <th>Supprimer</th>
                                            <th>Modifier</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($searchResults as $employe): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($employe['id']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Matricule']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Nom']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Postnom']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Prenom']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['DateNaissance']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['NumTelephone']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['NomDivision']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Remuneration']); ?></td>
                                                <td><?php echo htmlspecialchars($employe['Genre']); ?></td>
                                                <td>
                                                    <a href="supprimerEmploye.php?id=<?php echo $employe["id"] ?>" class="link-danger"><i class="fa-solid fa-trash fs-5"></i></a>
                                                </td>
                                                <td>
                                                    <a href="modifierEmployes.php?id=<?php echo $employe["id"] ?>" class="link-success"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
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
