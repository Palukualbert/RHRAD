<?php
require_once 'gererRetraiteEmployes.php'; // Inclure le fichier contenant les fonctions

// Initialiser les variables
$retraiteEmployees = [];
$searchTerm = '';

// Gérer la recherche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchTerm = trim($_POST['search']);
    $retraiteEmployees = searchRetraiteEmployees($searchTerm);
} else {
    $retraiteEmployees = getRetraiteEmployees();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retraite Employés</title>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <style>
            body {
            background-color: #f8f9fa;
            overflow-x: hidden; /* Empêche le défilement horizontal inutile */
        }

        .table-container {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            overflow-y: visible; /* Permet l'extension du contenu */
        }

        .table {
            margin-bottom: 0;
            font-size: 0.9rem;
            width: 100%; /* Utilise toute la largeur */
        }

        thead th {
            text-align: center;
            position: sticky;
            top: 0;
            white-space: nowrap;
        }

        tbody td {
            text-align: center;
            white-space: nowrap;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .alert {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo me-5 d-flex align-items-center" href="#">
                <div class="d-flex align-items-center">
                    <img src="../../assets/images/logo_RHRAD.png" alt="logo" width="110" height="60" />
                </div>
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex justify-content-end">
            <a href="login.php"><button class="btn btn-outline-danger">Se déconnecter</button></a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-5 pt-5">
    <h2 class="text-center mb-4">Liste des Employés en Retraite</h2>
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher l'employé en retraite" value="<?= htmlspecialchars($searchTerm) ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a href="retraiteEmployes.php" class="btn btn-secondary">Actualiser</a>
            <a href="encodeur_conges.php" class="btn btn-success">Retourner</a>
        </div>
    </form>
    <div class="table-container">
        <?php if (count($retraiteEmployees) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>N°</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Postnom</th>
                            <th>Date de Naissance</th>
                            <th>Age</th>
                            <th>Années de Service</th>
                            <th>Grade</th>
                            <th>Division</th>
                            <th>Date Enregistrement</th>
                            <th>Début Retraite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($retraiteEmployees as $index => $employee): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($employee['Matricule']) ?></td>
                                <td><?= htmlspecialchars($employee['Nom']) ?></td>
                                <td><?= htmlspecialchars($employee['PostNom']) ?></td>
                                <td><?= (new DateTime($employee['DateNaissance']))->format('d-m-Y') ?></td>
                                <td><?= htmlspecialchars($employee['Age']) ?> ans</td>
                                <td><?= htmlspecialchars($employee['AnneesService']) ?> ans</td>
                                <td><?= htmlspecialchars($employee['Grade']) ?></td>
                                <td><?= htmlspecialchars($employee['NomDivision']) ?></td>
                                <td><?= (new DateTime($employee['Date_Enregistrement']))->format('d-m-Y') ?></td>
                                <td><?= (new DateTime($employee['DateDebutRetraite']))->format('d-m-Y') ?></td>
                                <td class="action-buttons">
                                    <a href="modifierRetraiteEmploye.php?id=<?= htmlspecialchars($employee['Matricule']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-3">
                <i class="fas fa-exclamation-circle"></i> 
                Aucun employé trouvé pour la recherche : <strong><?= htmlspecialchars($searchTerm) ?></strong>
            </div>
        <?php endif; ?>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

