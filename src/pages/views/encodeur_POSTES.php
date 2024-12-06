<?php
include 'traitement.php';

$traitement = new traitement();
$search = $_POST['search'] ?? '';
$result = $traitement->rechercherHistoriquePostes($search);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $division = $_POST['division'];
    $dateDebut = $_POST['date_debut'];
    $grade = $_POST['grade'];
    $dateFin = $_POST['date_fin'];

    if ($traitement->modifierHistoriquePoste($id, $division, $dateDebut, $grade, $dateFin)) {
        echo "<script>alert('Modification réussie.');</script>";
    } else {
        echo "<script>alert('Erreur lors de la modification.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Postes</title>
    <!-- Ajouter Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav img {
            height: 50px;
        }

        nav .logout-btn {
            background-color: #ff4b5c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        nav .logout-btn:hover {
            background-color: #e63e4d;
        }

        /* Titre */
        .page-title {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Main content */
        main {
            padding: 20px;
        }

        /* Barre de recherche */
        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .search-container form {
            display: flex;
            gap: 10px;
        }

        .search-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 250px;
        }

        .search-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }

        /* Réduction de la taille du tableau */
        .table-container {
            width: 80%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
            font-size: 16px; /* Réduit la taille du texte */
        }

        table thead {
            color: #1c1c04;
            text-transform: uppercase;
        }

        table th,
        table td {
            padding: 10px; /* Réduit l'espacement */
            text-align: left;
            border: 1px solid #ddd;
        }

        table th:first-child,
        table td:first-child {
            border-left: none;
        }

        table th:last-child,
        table td:last-child {
            border-right: none;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:first-child th {
            border-top: none;
        }

        .responsive-table {
            overflow-x: auto;
        }

        /* Bouton compact pour les actions */
        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            background-color: #f8f9fa;
            color: #666;
            border-top: 1px solid #ddd;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                gap: 10px;
            }

            .search-container input {
                width: 100%;
            }

            .table-container {
                width: 95%; /* Réduit encore plus le tableau sur mobile */
            }

            table {
                font-size: 12px; /* Texte encore plus petit sur mobile */
            }
        }
    </style>
</head>
<body>
<!-- Barre de navigation -->
<nav>
    <a href="#">
        <img src="../../assets/images/logo_RHRAD.png" alt="Logo" width="100" />
    </a>
    <button class="logout-btn" onclick="window.location.href='login.php'">Se déconnecter</button>
</nav>

<!-- Titre -->
<div class="page-title">Historique des Postes</div>

<main>
    <!-- Barre de recherche -->
    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Rechercher par matricule ou nom" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Rechercher</button>
        </form>
        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-success"><i class="fas fa-sync"></i> Actualiser</a>
    </div>
    <!-- Tableau des résultats -->
    <table>
        <thead>
        <?php if (!empty($search)): ?>
            <tr>
                <th>Grade</th>
                <th>Date Début</th>
                <th>Date Fin</th>
            </tr>
        <?php else: ?>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>PostNom</th>
                <th>Division</th>
                <th>Grade</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        <?php endif; ?>
        </thead>
        <tbody>
        <?php if (count($result) > 0): ?>
            <?php foreach ($result as $row): ?>
                <tr>
                    <?php if (!empty($search)): ?>
                        <td><?= htmlspecialchars($row['Grade']) ?></td>
                        <td><?= htmlspecialchars($row['Date_debut']) ?></td>
                        <td><?= htmlspecialchars($row['Date_fin'] ?: 'Actuel') ?></td>
                    <?php else: ?>
                        <td><?= htmlspecialchars($row['Matricule']) ?></td>
                        <td><?= htmlspecialchars($row['Nom']) ?></td>
                        <td><?= htmlspecialchars($row['PostNom']) ?></td>
                        <td><?= htmlspecialchars($row['Division']) ?></td>
                        <td><?= htmlspecialchars($row['Grade']) ?></td>
                        <td><?= htmlspecialchars($row['Date_debut']) ?></td>
                        <td><?= htmlspecialchars($row['Date_fin'] ?: 'Actuel') ?></td>
                        <td>
                            <a href="modifier_postes.php?id=<?= $row['id'] ?>" class="btn btn-success" style="text-align: center">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Aucun résultat trouvé</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
